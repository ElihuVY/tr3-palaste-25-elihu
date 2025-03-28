export interface Product {
  id: number
  name: string
  price: number
  category: string
  image: string
  description: string
}

export interface CartItem {
  product: Product
  quantity: number
}

export interface User {
  id: number
  name: string
  email: string
  avatar?: string
  created_at: string
}

export interface Order {
  id: number
  user_id: number
  total: number
  status: 'pending' | 'processing' | 'completed' | 'cancelled'
  created_at: string
  items: OrderItem[]
}

export interface OrderItem {
  id: number
  order_id: number
  product: Product
  quantity: number
  price: number
}

export interface ProjectRequest {
  id: number
  user_id: number
  title: string
  description: string
  status: 'pending' | 'in_review' | 'approved' | 'rejected'
  created_at: string
}