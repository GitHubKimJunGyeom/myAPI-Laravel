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

export interface PathNote {
    id: number
    title : string
    content_ko: string
    content_ja: string
    created_at: string
    updated_at: string
}