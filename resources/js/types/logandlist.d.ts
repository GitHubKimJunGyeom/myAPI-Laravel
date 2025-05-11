export interface Comments {
    id: number
    user_id : string
    nickname : string
    content: string
    page_id: number
    parent_id: number | null
    created_at: string
    updated_at: string
}