// src/types/vue.d.ts

import { Inertia } from '@inertiajs/inertia'
import { Page } from '@inertiajs/inertia'

declare module '@vue/runtime-core' {
  interface ComponentCustomProperties {
    $inertia: Inertia
    $page: Page
  }
}
