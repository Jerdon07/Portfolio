<script setup lang="ts">

defineProps({
    personalInfo: {
        type: Object,
        required: true
    }
})

const emit = defineEmits<{
    (e: 'navigate', section: string): void
}>()
const handleScroll = (section: string) => {
    emit('navigate', section)
}
</script>

<template>
    <nav class="fixed top-0 left-0 right-0 z-50 border-b bg-background/80 backdrop-blur-sm">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="text-lg font-semibold">
                    {{ personalInfo.name.split(' ')[0] }}
                </div>
                <div class="hidden space-x-8 md:flex">
                    <button @click="handleScroll('home')" class="text-sm hover:text-primary transition-colors">
                        Home
                    </button>
                    <button @click="handleScroll('projects')" class="text-sm hover:text-primary transition-colors">
                        Projects
                    </button>
                    <button @click="handleScroll('skills')" class="text-sm hover:text-primary transition-colors">
                        Skills
                    </button>
                    <button @click="handleScroll('about')" class="text-sm hover:text-primary transition-colors">
                        About
                    </button>
                    <button @click="handleScroll('contact')" class="text-sm hover:text-primary transition-colors">
                        Contact
                    </button>
                </div>
            </div>
        </div>
    </nav>
</template>