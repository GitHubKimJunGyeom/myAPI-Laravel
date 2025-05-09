export interface Comments {
    id: number
    page_id: number
    parent_id: number | null
    name: string
    email: string
    content: string
    created_at: string
    updated_at: string
}