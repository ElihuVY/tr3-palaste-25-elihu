<template>
  
  <div class="project-request-container">
    <h2 class="title">Solicitud de Proyecto de Soldadura</h2>
    
    <form @submit.prevent="submitRequest" v-if="!requestSent" class="request-form">
      <!-- Información básica del cliente -->
      <div class="client-info-section">
        <h3 class="section-title">📋 Información del Cliente</h3>
        <div class="form-row">
          <div class="form-group">
            <label for="name">Nombre completo:</label>
            <input type="text" id="name" v-model="form.name" required class="form-input">
          </div>
          
          <div class="form-group">
            <label for="phone">Teléfono:</label>
            <input type="tel" id="phone" v-model="form.phone" required class="form-input" placeholder="+34 123 456 789">
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" v-model="form.email" required class="form-input">
          </div>
          
          <div class="form-group">
            <label for="address">Dirección (opcional):</label>
            <input type="text" id="address" v-model="form.address" class="form-input" placeholder="Calle, número, ciudad, código postal">
          </div>
        </div>
      </div>
      
      <!-- Selección de tipo de proyecto -->
      <div class="project-type-section">
        <h3 class="section-title">🔧 Tipo de Proyecto</h3>
        <div class="project-type-options">
          <button type="button" 
                  v-for="type in project_types" 
                  :key="type.value" 
                  @click="selectproject_type(type.value)"
                  :class="['type-option', { 'active': form.project_type === type.value }]">
            <span class="type-icon">{{ type.icon }}</span>
            {{ type.label }}
          </button>
        </div>
      </div>
      
      <!-- Opciones específicas según tipo de proyecto -->
      <div v-if="form.project_type" class="specific-options-section">
        <h3 class="section-title">⚙️ Detalles del Proyecto</h3>
        
        <!-- Opciones para escaleras -->
        <div v-if="form.project_type === 'stairs'" class="options-group">
          <div class="form-row">
            <div class="form-group">
              <label for="stairs-type">Tipo de escalera:</label>
              <select id="stairs-type" v-model="form.stairs.type" class="form-select">
                <option value="">Seleccione...</option>
                <option value="interior">Interior</option>
                <option value="exterior">Exterior</option>
                <option value="industrial">Industrial</option>
                <option value="caracol">De caracol</option>
                <option value="recta">Recta</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="stairs-material">Material principal:</label>
              <select id="stairs-material" v-model="form.stairs.material" class="form-select">
                <option value="">Seleccione...</option>
                <option value="acero">Acero</option>
                <option value="inoxidable">Acero inoxidable</option>
                <option value="hierro">Hierro forjado</option>
                <option value="mixta">Mixta (madera/metal)</option>
              </select>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="stairs-railings">¿Incluye barandillas?</label>
              <select id="stairs-railings" v-model="form.stairs.hasRailings" class="form-select">
                <option value="yes">Sí</option>
                <option value="no">No</option>
                <option value="unsure">No estoy seguro</option>
              </select>
            </div>
            
            <div v-if="form.stairs.hasRailings === 'yes'" class="form-group">
              <label for="railings-style">Estilo de barandillas:</label>
              <select id="railings-style" v-model="form.stairs.railingsStyle" class="form-select">
                <option value="">Seleccione...</option>
                <option value="modern">Moderno (líneas rectas)</option>
                <option value="classic">Clásico (diseños ornamentados)</option>
                <option value="industrial">Industrial (tuberías visibles)</option>
                <option value="minimalist">Minimalista (vidrio/acero)</option>
              </select>
            </div>
          </div>
        </div>
        
        <!-- Opciones para barandillas -->
        <div v-if="form.project_type === 'railings'" class="options-group">
          <div class="form-row">
            <div class="form-group">
              <label for="railings-location">Ubicación:</label>
              <select id="railings-location" v-model="form.railings.location" class="form-select">
                <option value="">Seleccione...</option>
                <option value="balcony">Balcón</option>
                <option value="terrace">Terraza</option>
                <option value="staircase">Escalera</option>
                <option value="window">Protección de ventana</option>
                <option value="pool">Alrededor de piscina</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="railings-material">Material:</label>
              <select id="railings-material" v-model="form.railings.material" class="form-select">
                <option value="">Seleccione...</option>
                <option value="acero">Acero</option>
                <option value="inoxidable">Acero inoxidable</option>
                <option value="hierro">Hierro forjado</option>
                <option value="aluminio">Aluminio</option>
              </select>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="railings-style">Estilo:</label>
              <select id="railings-style" v-model="form.railings.style" class="form-select">
                <option value="">Seleccione...</option>
                <option value="modern">Moderno</option>
                <option value="classic">Clásico</option>
                <option value="custom">Diseño personalizado</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="railings-height">Altura aproximada (cm):</label>
              <input type="number" id="railings-height" v-model="form.railings.height" class="form-input" placeholder="Ej: 100">
            </div>
          </div>
        </div>
        
        <!-- Opciones para puertas -->
        <div v-if="form.project_type === 'doors'" class="options-group">
          <div class="form-row">
            <div class="form-group">
              <label for="door-type">Tipo de puerta:</label>
              <select id="door-type" v-model="form.doors.type" class="form-select">
                <option value="">Seleccione...</option>
                <option value="exterior">Puerta exterior</option>
                <option value="interior">Puerta interior</option>
                <option value="garage">Puerta de garaje</option>
                <option value="security">Puerta de seguridad</option>
                <option value="sliding">Corredera</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="door-material">Material:</label>
              <select id="door-material" v-model="form.doors.material" class="form-select">
                <option value="">Seleccione...</option>
                <option value="acero">Acero</option>
                <option value="hierro">Hierro</option>
                <option value="mixta">Mixta (madera/metal)</option>
              </select>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="door-style">Estilo:</label>
              <select id="door-style" v-model="form.doors.style" class="form-select">
                <option value="">Seleccione...</option>
                <option value="modern">Moderno</option>
                <option value="classic">Clásico</option>
                <option value="industrial">Industrial</option>
                <option value="custom">Personalizado</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="door-dimensions">Dimensiones (ancho x alto en cm):</label>
              <input type="text" id="door-dimensions" v-model="form.doors.dimensions" class="form-input" placeholder="Ej: 90x210">
            </div>
          </div>
        </div>
        
        <!-- Opciones para otros proyectos -->
        <div v-if="form.project_type === 'other'" class="options-group">
          <div class="form-group">
            <label for="other-type">¿Qué necesitas?</label>
            <select id="other-type" v-model="form.other.type" class="form-select">
              <option value="">Seleccione...</option>
              <option value="structure">Estructura metálica</option>
              <option value="furniture">Mueble de metal</option>
              <option value="art">Pieza artística/decorativa</option>
              <option value="repair">Reparación</option>
              <option value="custom">Proyecto personalizado</option>
            </select>
          </div>
          
          <div v-if="form.other.type" class="form-group">
            <label for="other-details">Detalles adicionales:</label>
            <textarea id="other-details" v-model="form.other.details" class="form-textarea" placeholder="Describe lo que necesitas..."></textarea>
          </div>
        </div>
      </div>
      
      <!-- Descripción del proyecto con IA -->
      <div class="description-section">
        <h3 class="section-title">📝 Descripción del Proyecto</h3>
        
        <div class="form-group">
          <label for="description">Cuéntanos más detalles sobre lo que necesitas:</label>
          <textarea id="description" v-model="form.description" required class="form-textarea" placeholder="Describe tu proyecto con todos los detalles importantes..."></textarea>
          
          <div class="ai-assistant">
            <button type="button" @click="improveDescription" class="action-btn improve-btn" :disabled="isImproving">
              <span class="icon">✨</span> 
              {{ isImproving ? 'Generando...' : 'Mejorar descripción con IA' }}
            </button>
            
            <div v-if="aiSuggestions.length > 0" class="suggestions-box">
              <h4>Sugerencias de la IA:</h4>
              <div v-for="(suggestion, index) in aiSuggestions" :key="index" class="suggestion-item">
                <p>{{ suggestion }}</p>
                <button type="button" @click="applySuggestion(suggestion)" class="suggestion-btn">Usar esta sugerencia</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Adjuntos y envío -->
      <div class="attachments-section">
        <h3 class="section-title">📎 Adjuntos</h3>
        
        <div class="form-group">
          <label for="files">Adjunta fotos, planos o referencias:</label>
          <input type="file" id="files" multiple @change="handleFiles" class="file-input" accept="image/*,.pdf,.doc,.docx">
          
          <div v-if="form.files.length > 0" class="file-preview">
            <div v-for="(file, index) in form.files" :key="index" class="file-item">
              <span class="file-icon">📄</span>
              <span class="file-name">{{ file.name }}</span>
              <button type="button" @click="removeFile(index)" class="remove-file-btn">×</button>
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label for="budget">Presupuesto aproximado (opcional):</label>
          <input type="text" id="budget" v-model="form.budget" class="form-input" placeholder="Ej: 500-700€">
        </div>
        
        <div class="form-group">
          <label for="timeline">¿Cuándo necesitas el proyecto?</label>
          <select id="timeline" v-model="form.timeline" class="form-select">
            <option value="">Sin prisa</option>
            <option value="1-2 weeks">En 1-2 semanas</option>
            <option value="3-4 weeks">En 3-4 semanas</option>
            <option value="urgent">Urgente (lo antes posible)</option>
            <option value="specific">Fecha específica</option>
          </select>
        </div>
      </div>
      
      <div class="form-actions">
        <button type="submit" class="action-btn submit-btn">
          <span class="icon">📨</span> Enviar Solicitud
        </button>
      </div>
    </form>
    
    <!-- Pantalla de confirmación -->
    <div v-else class="confirmation-screen">
      <div class="confirmation-content">
        <div class="success-icon">✅</div>
        <h3 class="confirmation-title">¡Solicitud enviada con éxito!</h3>
        
        <div class="request-summary">
          <h4>Resumen de tu solicitud:</h4>
          <p><strong>Tipo de proyecto:</strong> {{ getproject_typeLabel(savedRequest.project_type) }}</p>
          <p><strong>Nombre:</strong> {{ savedRequest.name }}</p>
          <p><strong>Contacto:</strong> {{ savedRequest.phone }} | {{ savedRequest.email }}</p>
          <p v-if="savedRequest.address"><strong>Dirección:</strong> {{ savedRequest.address }}</p>
          
          <!-- Mostrar detalles específicos según el tipo de proyecto -->
          <div v-if="savedRequest.project_type === 'stairs'">
            <p><strong>Tipo de escalera:</strong> {{ savedRequest.stairs.type || 'No especificado' }}</p>
            <p><strong>Material:</strong> {{ savedRequest.stairs.material || 'No especificado' }}</p>
            <p v-if="savedRequest.stairs.hasRailings === 'yes'"><strong>Estilo de barandillas:</strong> {{ savedRequest.stairs.railingsStyle || 'No especificado' }}</p>
          </div>
          
          <div v-else-if="savedRequest.project_type === 'railings'">
            <p><strong>Ubicación:</strong> {{ savedRequest.railings.location || 'No especificado' }}</p>
            <p><strong>Material:</strong> {{ savedRequest.railings.material || 'No especificado' }}</p>
            <p><strong>Estilo:</strong> {{ savedRequest.railings.style || 'No especificado' }}</p>
            <p v-if="savedRequest.railings.height"><strong>Altura:</strong> {{ savedRequest.railings.height }} cm</p>
          </div>
          
          <div v-else-if="savedRequest.project_type === 'doors'">
            <p><strong>Tipo de puerta:</strong> {{ savedRequest.doors.type || 'No especificado' }}</p>
            <p><strong>Material:</strong> {{ savedRequest.doors.material || 'No especificado' }}</p>
            <p><strong>Estilo:</strong> {{ savedRequest.doors.style || 'No especificado' }}</p>
            <p v-if="savedRequest.doors.dimensions"><strong>Dimensiones:</strong> {{ savedRequest.doors.dimensions }}</p>
          </div>
          
          <div v-else-if="savedRequest.project_type === 'other'">
            <p><strong>Tipo:</strong> {{ savedRequest.other.type || 'No especificado' }}</p>
            <p v-if="savedRequest.other.details"><strong>Detalles:</strong> {{ savedRequest.other.details }}</p>
          </div>
          
          <p><strong>Descripción:</strong> {{ savedRequest.description }}</p>
          <p v-if="savedRequest.budget"><strong>Presupuesto:</strong> {{ savedRequest.budget }}</p>
          <p v-if="savedRequest.timeline"><strong>Plazo:</strong> {{ savedRequest.timeline }}</p>
          <p v-if="savedRequest.files.length > 0"><strong>Archivos adjuntos:</strong> {{ savedRequest.files.length }}</p>
        </div>
        
        <p class="confirmation-message">
          Hemos recibido tu solicitud y nuestro equipo la está revisando. 
          Te contactaremos en un plazo de 24-48 horas para discutir los detalles 
          y proporcionarte un presupuesto detallado. Puedes registrarte y ver tus pedidos y solicitudes en tu perfil.
        </p>
        
        <div class="confirmation-actions">
          <button @click="resetForm" class="action-btn submit-btn">
            <span class="icon">➕</span> Enviar otra solicitud
          </button>
          <button @click="downloadSummary" class="action-btn download-btn">
            <span class="icon">📥</span> Descargar resumen
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script scoped>
      import { laravel } from '@/comunication_manager' 

export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        phone: '',
        address: '',
        project_type: '',
        description: '',
        budget: '',
        timeline: '',
        files: [],
        
        // Opciones específicas para escaleras
        stairs: {
          type: '',
          material: '',
          hasRailings: 'yes',
          railingsStyle: ''
        },
        
        // Opciones específicas para barandillas
        railings: {
          location: '',
          material: '',
          style: '',
          height: ''
        },
        
        // Opciones específicas para puertas
        doors: {
          type: '',
          material: '',
          style: '',
          dimensions: ''
        },
        
        // Opciones para otros proyectos
        other: {
          type: '',
          details: ''
        }
      },
      savedRequest: {},
      requestSent: false,
      isImproving: false,
      aiSuggestions: [],
      project_types: [
        { value: 'stairs', label: 'Escaleras', icon: '📶' },
        { value: 'railings', label: 'Barandillas', icon: '🚧' },
        { value: 'doors', label: 'Puertas', icon: '🚪' },
        { value: 'other', label: 'Otro proyecto', icon: '🔩' }
      ],
      errorMessage: null
    };
  },
  methods: {
    getproject_typeLabel(value) {
      const type = this.project_types.find(t => t.value === value);
      return type ? type.label : 'No especificado';
    },
    selectproject_type(type) {
      this.form.project_type = type;
      // Resetear campos específicos al cambiar tipo de proyecto
      this.form.stairs = { type: '', material: '', hasRailings: 'yes', railingsStyle: '' };
      this.form.railings = { location: '', material: '', style: '', height: '' };
      this.form.doors = { type: '', material: '', style: '', dimensions: '' };
      this.form.other = { type: '', details: '' };
    },
    handleFiles(event) {
      this.form.files = Array.from(event.target.files);
    },
    removeFile(index) {
      this.form.files.splice(index, 1);
    },
    async improveDescription() {
      if (!this.form.description.trim()) {
        alert('Por favor escribe una descripción inicial para que la IA pueda mejorarla');
        return;
      }
      
      this.isImproving = true;
      this.aiSuggestions = [];
      
      try {
        // Simulación de llamada a IA con diferentes sugerencias
        await new Promise(resolve => setTimeout(resolve, 1500));
        
        // Generar sugerencias basadas en el tipo de proyecto
        if (this.form.project_type === 'stairs') {
          this.aiSuggestions = [
            `Escalera de ${this.form.stairs.material || 'metal'} para ${this.form.stairs.type || 'interior/exterior'}. ` +
            `Incluye ${this.form.stairs.hasRailings === 'yes' ? 'barandillas de estilo ' + (this.form.stairs.railingsStyle || 'moderno') : 'sin barandillas'}. ` +
            `Necesito un diseño ${this.form.stairs.type === 'caracol' ? 'espiral que optimice el espacio' : 'funcional y resistente'}.`,
            
            `Proyecto de escalera metálica con las siguientes características:\n` +
            `- Tipo: ${this.form.stairs.type || 'por definir'}\n` +
            `- Material principal: ${this.form.stairs.material || 'acero/inoxidable'}\n` +
            `- Barandillas: ${this.form.stairs.hasRailings === 'yes' ? 'Sí, estilo ' + (this.form.stairs.railingsStyle || 'a elegir') : 'No'}\n` +
            `- Requisitos adicionales: ${this.form.description || 'ninguno especificado'}`
          ];
        } 
        else if (this.form.project_type === 'railings') {
          this.aiSuggestions = [
            `Barandilla de ${this.form.railings.material || 'metal'} para ${this.form.railings.location || 'ubicación por definir'}. ` +
            `Estilo ${this.form.railings.style || 'moderno'}, altura aproximada ${this.form.railings.height || '100'} cm. ` +
            `Necesito que sea ${this.form.railings.location === 'pool' ? 'resistente a la humedad y con diseño seguro' : 'estética y funcional'}.`,
            
            `Especificaciones para barandilla:\n` +
            `- Ubicación: ${this.form.railings.location || 'por determinar'}\n` +
            `- Material: ${this.form.railings.material || 'acero/inoxidable'}\n` +
            `- Estilo: ${this.form.railings.style || 'moderno/clásico'}\n` +
            `- Altura: ${this.form.railings.height || '100'} cm\n` +
            `- Detalles adicionales: ${this.form.description || 'ninguno'}`
          ];
        }
        else if (this.form.project_type === 'doors') {
          this.aiSuggestions = [
            `Puerta de ${this.form.doors.material || 'metal'} para ${this.form.doors.type || 'uso por definir'}. ` +
            `Estilo ${this.form.doors.style || 'moderno'}, dimensiones ${this.form.doors.dimensions || 'estándar'}. ` +
            `Requisitos: ${this.form.doors.type === 'security' ? 'alta seguridad y resistencia' : 'diseño atractivo y funcionalidad'}.`,
            
            `Detalles para puerta metálica:\n` +
            `- Tipo: ${this.form.doors.type || 'exterior/interior'}\n` +
            `- Material: ${this.form.doors.material || 'acero/hierro'}\n` +
            `- Estilo: ${this.form.doors.style || 'moderno/clásico'}\n` +
            `- Dimensiones: ${this.form.doors.dimensions || 'por determinar'}\n` +
            `- Consideraciones especiales: ${this.form.description || 'ninguna'}`
          ];
        }
        else {
          // Sugerencias genéricas para otros proyectos
          this.aiSuggestions = [
            `Proyecto de soldadura personalizado. Tipo: ${this.form.other.type || 'estructura/mueble/arte'}. ` +
            `Detalles: ${this.form.other.details || 'por especificar'}. ` +
            `Requisitos técnicos: ${this.form.description || 'ninguno indicado'}.`,
            
            `Descripción detallada del proyecto:\n` +
            `- Tipo: ${this.form.other.type || 'personalizado'}\n` +
            `- Materiales preferidos: ${this.form.description.includes('material') ? '' : 'por determinar'}\n` +
            `- Dimensiones aproximadas: ${this.form.description.includes('medida') ? '' : 'no especificadas'}\n` +
            `- Uso/función: ${this.form.other.details || 'por definir'}\n` +
            `- Detalles adicionales: ${this.form.description || 'ninguno'}`
          ];
        }
        
      } catch (error) {
        console.error('Error al mejorar la descripción:', error);
        alert('Ocurrió un error al generar sugerencias. Por favor inténtalo de nuevo.');
      } finally {
        this.isImproving = false;
      }
    },
    applySuggestion(suggestion) {
      this.form.description = suggestion;
      this.aiSuggestions = [];
    },

    
    async submitRequest() {
      // Validación básica
      if (!this.form.project_type) {
        alert('Por favor selecciona el tipo de proyecto');
        return;
      }
      this.errorMessage = null;
      this.isSubmitting = true;
      
      // Preparar FormData para enviar archivos
      const formData = new FormData();
      
      // Datos básicos
      formData.append('name', this.form.name);
      formData.append('email', this.form.email);
      formData.append('phone', this.form.phone);
      formData.append('address', this.form.address);
      formData.append('project_type', this.form.project_type);
      formData.append('description', this.form.description);
      formData.append('budget', this.form.budget);
      formData.append('timeline', this.form.timeline);
      
      // Agregar detalles específicos del tipo de proyecto
      formData.append(this.form.project_type, JSON.stringify(this.form[this.form.project_type]));
      
      // Agregar archivos
      this.form.files.forEach((file, index) => {
        formData.append(`files[${index}]`, file);
      });
      try {
        const response = await fetch('http://localhost:8000/api/project-requests', {
          method: 'POST',
          body: formData,
          headers: {
            'Accept': 'application/json'
          },
        });
        
        const data = await response.json();
        
        if (!response.ok) {
          throw new Error(data.message || 'Error en el envío de la solicitud');
        }
        
        this.savedRequest = JSON.parse(JSON.stringify(this.form));
        this.requestSent = true;
        console.log('Solicitud enviada:', this.savedRequest);
      } catch (error) {
        this.errorMessage = error.message;
      }finally {
        this.isSubmitting = false;
      }

    },
    resetForm() {
      this.form = { 
        name: '', 
        email: '', 
        phone: '', 
        address: '',
        project_type: '',
        description: '',
        budget: '',
        timeline: '',
        files: [],
        stairs: { type: '', material: '', hasRailings: 'yes', railingsStyle: '' },
        railings: { location: '', material: '', style: '', height: '' },
        doors: { type: '', material: '', style: '', dimensions: '' },
        other: { type: '', details: '' }
      };
      this.requestSent = false;
      this.aiSuggestions = [];
    },
    downloadSummary() {
      // Simulación de descarga de resumen
      alert('Funcionalidad de descarga activada (simulación)');
    }
  }
};
</script>

<style scoped>
.project-request-container {
  max-width: 900px;
  margin: 2rem auto;
  padding: 2rem;
  background-color: #f9f9f9;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.title {
  text-align: center;
  color: #2c3e50;
  margin-bottom: 2rem;
  font-size: 2rem;
}

.section-title {
  color: #3a5169;
  margin: 1.5rem 0 1rem;
  padding-bottom: 0.5rem;
  border-bottom: 2px solid #e1e5eb;
  font-size: 1.3rem;
}

.request-form {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.form-row {
  display: flex;
  gap: 1.5rem;
  margin-bottom: 1rem;
}

.form-row .form-group {
  flex: 1;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  margin-bottom: 1rem;
}

.form-input, .form-textarea, .form-select {
  padding: 0.8rem 1rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 1rem;
  transition: all 0.3s ease;
  background-color: white;
}

.form-input:focus, .form-textarea:focus, .form-select:focus {
  border-color: #42b983;
  outline: none;
  box-shadow: 0 0 0 3px rgba(66, 185, 131, 0.2);
}

.form-textarea {
  min-height: 150px;
  resize: vertical;
}

.form-select {
  appearance: none;
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 0.8rem center;
  background-size: 1rem;
}

.project-type-options {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 1rem;
  margin-top: 1rem;
}

.type-option {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 1.5rem 1rem;
  border: 2px solid #e1e5eb;
  border-radius: 8px;
  background-color: white;
  cursor: pointer;
  transition: all 0.3s ease;
  text-align: center;
}

.type-option:hover {
  border-color: #42b983;
  transform: translateY(-3px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.type-option.active {
  border-color: #42b983;
  background-color: #f0faf5;
  font-weight: 500;
}

.type-icon {
  font-size: 1.8rem;
  margin-bottom: 0.5rem;
}

.file-input {
  width: 100%;
  padding: 0.5rem;
  border: 1px dashed #ccc;
  border-radius: 8px;
  background-color: #f8f9fa;
}

.file-input:hover {
  border-color: #42b983;
}

.file-preview {
  margin-top: 0.8rem;
}

.file-item {
  display: flex;
  align-items: center;
  padding: 0.6rem 1rem;
  background-color: #f0f0f0;
  border-radius: 6px;
  margin-bottom: 0.5rem;
}

.file-icon {
  margin-right: 0.8rem;
  font-size: 1.2rem;
}

.file-name {
  flex: 1;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.remove-file-btn {
  background: none;
  border: none;
  color: #ff6b6b;
  font-size: 1.2rem;
  cursor: pointer;
  padding: 0 0.3rem;
}

.ai-assistant {
  margin-top: 1rem;
}

.suggestions-box {
  margin-top: 1rem;
  padding: 1rem;
  background-color: #f8f9fa;
  border-radius: 8px;
  border: 1px solid #e1e5eb;
}

.suggestions-box h4 {
  margin-top: 0;
  color: #3a5169;
  font-size: 1rem;
}

.suggestion-item {
  padding: 0.8rem;
  margin: 0.5rem 0;
  background-color: white;
  border-radius: 6px;
  border-left: 3px solid #42b983;
}

.suggestion-btn {
  margin-top: 0.5rem;
  padding: 0.4rem 0.8rem;
  background-color: #f0faf5;
  border: 1px solid #42b983;
  border-radius: 4px;
  color: #42b983;
  font-size: 0.9rem;
  cursor: pointer;
  transition: all 0.2s ease;
}

.suggestion-btn:hover {
  background-color: #42b983;
  color: white;
}

.action-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  padding: 0.8rem 1.5rem;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
}

.action-btn .icon {
  font-size: 1.2rem;
}

.action-btn:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.action-btn:not(:disabled):hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.submit-btn {
  background-color: #42b983;
  color: white;
}

.submit-btn:hover:not(:disabled) {
  background-color: #369f6e;
}

.improve-btn {
  background-color: #647eff;
  color: white;
}

.improve-btn:hover:not(:disabled) {
  background-color: #4d6bff;
}

.download-btn {
  background-color: #6c757d;
  color: white;
}

.download-btn:hover:not(:disabled) {
  background-color: #5a6268;
}

.form-actions, .confirmation-actions {
  display: flex;
  gap: 1rem;
  justify-content: center;
  margin-top: 2rem;
}

.confirmation-screen {
  text-align: center;
  padding: 2rem;
}

.confirmation-content {
  max-width: 700px;
  margin: 0 auto;
  background-color: white;
  padding: 2.5rem;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.success-icon {
  font-size: 3.5rem;
  color: #42b983;
  margin-bottom: 1.5rem;
}

.confirmation-title {
  color: #2c3e50;
  margin-bottom: 1.5rem;
  font-size: 1.8rem;
}

.request-summary {
  text-align: left;
  background-color: #f8f9fa;
  padding: 1.5rem;
  border-radius: 8px;
  margin: 2rem 0;
}

.request-summary h4 {
  margin-top: 0;
  color: #2c3e50;
  border-bottom: 1px solid #ddd;
  padding-bottom: 0.5rem;
}

.request-summary p {
  margin: 0.5rem 0;
}

.confirmation-message {
  color: #555;
  line-height: 1.6;
  margin-bottom: 2rem;
  font-size: 1.1rem;
}

@media (max-width: 768px) {
  .project-request-container {
    padding: 1rem;
    margin: 1rem;
  }
  
  .form-row {
    flex-direction: column;
    gap: 1rem;
  }
  
  .project-type-options {
    grid-template-columns: 1fr 1fr;
  }
  
  .form-actions, .confirmation-actions {
    flex-direction: column;
  }
  
  .action-btn {
    width: 100%;
  }
}

@media (max-width: 480px) {
  .project-type-options {
    grid-template-columns: 1fr;
  }
  
  .confirmation-content {
    padding: 1.5rem;
  }
}
</style>