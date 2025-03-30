<?php
// PedidoController.php
namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.producto_id' => 'required|exists:productos,id',
            'items.*.cantidad' => 'required|integer|min:1',
            'items.*.precio' => 'required|numeric|min:0', // Validación explícita
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|email',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'codigo_postal' => 'required|string|max:20',
            'notas' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();
            
            $total = 0;
            $pedidoItems = [];
            
            foreach ($request->items as $item) {
                // Obtener el producto para validar el precio
                $producto = Producto::findOrFail($item['producto_id']);
                
                $precio = $producto->precio;
                $subtotal = $precio * $item['cantidad'];
                $total += $subtotal;
                
                $pedidoItems[] = [
                    'producto_id' => $item['producto_id'],
                    'cantidad' => $item['cantidad'],
                    'precio' => $precio, // Precio desde la BD
                    'subtotal' => $subtotal
                ];
            }
            
            // Crear el pedido
            $pedido = Pedido::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'estado' => 'pendiente',
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'ciudad' => $request->ciudad,
                'codigo_postal' => $request->codigo_postal,
                'notas' => $request->notas,
            ]);
            
            // Crear los items del pedido
            foreach ($pedidoItems as $item) {
                $pedido->items()->create($item);
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Pedido creado correctamente',
                'pedido' => $pedido->load('items.producto')
            ], 201);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el pedido',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function index()
    {
        $pedidos = Pedido::with('items.producto')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json([
            'success' => true,
            'pedidos' => $pedidos
        ]);
    }
    
    public function show($id)
    {
        $pedido = Pedido::with('items.producto')
            ->where('user_id', Auth::id())
            ->findOrFail($id);
            
        return response()->json([
            'success' => true,
            'pedido' => $pedido
        ]);
    }
    
    // Para administradores
    public function adminIndex()
    {
        // Verificar permisos de administrador
        // $this->authorize('manage-pedidos');
        
        $pedidos = Pedido::with(['user', 'items.producto'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return response()->json([
            'success' => true,
            'pedidos' => $pedidos
        ]);
    }
    
    public function updateStatus(Request $request, $id)
    {
        // Verificar permisos de administrador
        // $this->authorize('manage-pedidos');
        
        $request->validate([
            'estado' => 'required|in:pendiente,procesando,completado,cancelado',
        ]);
        
        $pedido = Pedido::findOrFail($id);
        $pedido->update([
            'estado' => $request->estado
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Estado del pedido actualizado',
            'pedido' => $pedido->load('items.producto')
        ]);
    }
}
