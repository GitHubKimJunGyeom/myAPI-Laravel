<script setup lang="ts">
import myAPIIcon from '@/public/assets/img/png/myAPIIcon.png';

import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <img :src="myAPIIcon" alt="API Logo" class="h-8 w-8" />
</template>
