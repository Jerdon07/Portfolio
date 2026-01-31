<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Icon } from '@iconify/vue'
import Navigation from '@/components/Navigation.vue';

interface PersonalInfo {
    name: string
    title: string
    subtitle: string
    location: string
    status: string
    graduation: number
    availability: string
}

interface TechStack {
    name: string
    level: number
    category: string
}

interface Project {
    id: number
    name: string
    tagline: string
    description: string
    features: string[]
    tech: string[]
    github: string
    live_url: string | null
    status: string
    year: string
    image?: string
}

interface Social {
    platform: string
    url: string
    icon: string
}

interface Contact {
    email: string
    phone: string
}

interface Props {
    personalInfo: PersonalInfo
    techStack: TechStack[]
    projects: Project[]
    socials: Social[]
    contact: Contact
}

const props = defineProps<Props>()

const backendSkills = computed(() =>
    props.techStack.filter(skill => skill.category === 'backend')
)

const frontendSkills = computed(() => 
    props.techStack.filter(skill => skill.category === 'frontend')
)

const toolSkills = computed(() => 
    props.techStack.filter(skill => skill.category === 'tools')
)

const scrollToSection = (selectionId: string) => {
    const element = document.getElementById(selectionId)
    if (element) element.scrollIntoView({ behavior: 'smooth' })
}

const getSocialIcon = (icon: string) => {
    const icons: Record<string, any> = {
        github: 'simple-icons:github',
        linkedin: 'simple-icons:linkedin',
        facebook: 'simple-icons:facebook',
        discord: 'simple-icons:discord',
    }
    return icons[icon] || 'lucide:share-2'
}

const getSkillColor = (level: number) => {
    if (level >= 4) return 'bg-green-500';
    if (level >= 3) return 'bg-blue-500';
    if (level >= 2) return 'bg-yellow-500';
    return 'bg-gray-500';
}
</script>

<template>
    <Head>
        <title>{{ personalInfo.name }} = {{ personalInfo.title }}</title>
        <meta 
            name="description" 
            :content="`${personalInfo.name} - ${personalInfo.subtitle}. ${personalInfo.availability}`" 
        >
    </Head>

    <div class="min-h-screen bg-background">
        <!-- Navigation -->
        <Navigation 
            :personalInfo="personalInfo"
            @navigate="scrollToSection"
        />

        <!-- Hero Section -->
        <section id="home" class="flex min-h-screen items-center justify-center px-4 pt-16">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-8 inline-block rounded-full bg-primary/10 px-4 py-2 text-sm font-medium text-primary">
                    {{ personalInfo.availability }}
                </div>
                
                <h1 class="mb-4 text-4xl font-bold tracking-tight sm:text-6xl">
                    Hi, I'm {{ personalInfo.name }}
                </h1>
                
                <p class="mb-2 text-xl text-muted-foreground sm:text-2xl">
                    {{ personalInfo.title }}
                </p>
                
                <p class="mb-8 text-lg text-muted-foreground">
                    {{ personalInfo.subtitle }}
                </p>

                <div class="mb-12 flex flex-wrap items-center justify-center gap-4 text-sm text-muted-foreground">
                    <span class="flex items-center gap-2">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ personalInfo.location }}
                    </span>
                    <span>•</span>
                    <span>{{ personalInfo.status }}</span>
                    <span>•</span>
                    <span>Graduating {{ personalInfo.graduation }}</span>
                </div>

                <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <button 
                        @click="scrollToSection('projects')"
                        class="inline-flex items-center rounded-lg bg-primary px-6 py-3 text-sm font-medium text-primary-foreground hover:bg-primary/90 transition-colors"
                    >
                        View My Work
                    </button>
                    <button 
                        @click="scrollToSection('contact')"
                        class="inline-flex items-center rounded-lg border border-input px-6 py-3 text-sm font-medium hover:bg-accent transition-colors"
                    >
                        Contact Me
                    </button>
                </div>

                <!-- Social Links -->
                <div class="mt-12 flex items-center justify-center gap-4">
                    <a 
                        v-for="social in socials" 
                        :key="social.platform"
                        :href="social.url"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex h-10 w-10 items-center justify-center rounded-full border hover:bg-accent transition-colors"
                    >
                        <Icon :icon="getSocialIcon(social.icon)" class="h-5 w-5" />
                    </a>
                </div>
            </div>
        </section>

        <!-- Projects Section -->
        <section id="projects" class="min-h-screen px-4 py-20">
            <div class="mx-auto max-w-6xl">
                <div class="mb-12 text-center">
                    <h2 class="mb-4 text-3xl font-bold sm:text-4xl">Featured Projects</h2>
                    <p class="text-muted-foreground">Here are some projects I've worked on</p>
                </div>

                <div class="grid gap-8">
                    <article 
                        v-for="project in projects" 
                        :key="project.id"
                        class="overflow-hidden rounded-lg border bg-card"
                    >
                        <!-- Project Image Placeholder -->
                        <div class="aspect-video bg-muted flex items-center justify-center">
                            <p class="text-sm text-muted-foreground">Screenshot coming soon</p>
                        </div>

                        <div class="p-6">
                            <div class="mb-4 flex items-start justify-between">
                                <div>
                                    <h3 class="mb-1 text-2xl font-semibold">{{ project.name }}</h3>
                                    <p class="text-sm text-muted-foreground">{{ project.tagline }}</p>
                                </div>
                                <span class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-medium text-yellow-500">
                                    {{ project.status }}
                                </span>
                            </div>

                            <p class="mb-4 text-muted-foreground">
                                {{ project.description }}
                            </p>

                            <div class="mb-4">
                                <h4 class="mb-2 text-sm font-semibold">Key Features:</h4>
                                <ul class="list-inside list-disc space-y-1 text-sm text-muted-foreground">
                                    <li v-for="(feature, idx) in project.features" :key="idx">
                                        {{ feature }}
                                    </li>
                                </ul>
                            </div>

                            <div class="mb-6">
                                <h4 class="mb-2 text-sm font-semibold">Technologies Used:</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span 
                                        v-for="tech in project.tech" 
                                        :key="tech"
                                        class="rounded-full bg-primary/10 px-3 py-1 text-xs font-medium text-primary"
                                    >
                                        {{ tech }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <a 
                                    :href="project.github" 
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center gap-2 rounded-lg border px-4 py-2 text-sm font-medium hover:bg-accent transition-colors"
                                >
                                    <Github class="h-4 w-4" />
                                    View Code
                                </a>
                                <a 
                                    v-if="project.live_url"
                                    :href="project.live_url"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground hover:bg-primary/90 transition-colors"
                                >
                                    Live Demo
                                </a>
                            </div>
                        </div>
                    </article>

                    <!-- Placeholder for future projects -->
                    <div class="rounded-lg border border-dashed p-12 text-center">
                        <p class="text-muted-foreground">More projects coming soon...</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Skills Section -->
        <section id="skills" class="min-h-screen px-4 py-20 bg-muted/30">
            <div class="mx-auto max-w-6xl">
                <div class="mb-12 text-center">
                    <h2 class="mb-4 text-3xl font-bold sm:text-4xl">Skills & Technologies</h2>
                    <p class="text-muted-foreground">Technologies I work with and my proficiency levels</p>
                </div>

                <div class="grid gap-8 md:grid-cols-3">
                    <!-- Backend Skills -->
                    <div class="rounded-lg border bg-card p-6">
                        <h3 class="mb-6 text-xl font-semibold">Backend</h3>
                        <div class="space-y-4">
                            <div v-for="skill in backendSkills" :key="skill.name">
                                <div class="mb-2 flex items-center justify-between">
                                    <span class="font-medium">{{ skill.name }}</span>
                                    <span class="text-xs text-muted-foreground">{{ skill.level }}/5</span>
                                </div>
                                <div class="h-2 overflow-hidden rounded-full bg-muted">
                                    <div 
                                        :class="getSkillColor(skill.level)"
                                        :style="{ width: `${(skill.level / 5) * 100}%` }"
                                        class="h-full transition-all duration-500"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Frontend Skills -->
                    <div class="rounded-lg border bg-card p-6">
                        <h3 class="mb-6 text-xl font-semibold">Frontend</h3>
                        <div class="space-y-4">
                            <div v-for="skill in frontendSkills" :key="skill.name">
                                <div class="mb-2 flex items-center justify-between">
                                    <span class="font-medium">{{ skill.name }}</span>
                                    <span class="text-xs text-muted-foreground">{{ skill.level }}/5</span>
                                </div>
                                <div class="h-2 overflow-hidden rounded-full bg-muted">
                                    <div 
                                        :class="getSkillColor(skill.level)"
                                        :style="{ width: `${(skill.level / 5) * 100}%` }"
                                        class="h-full transition-all duration-500"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tools -->
                    <div class="rounded-lg border bg-card p-6">
                        <h3 class="mb-6 text-xl font-semibold">Tools</h3>
                        <div class="space-y-4">
                            <div v-for="skill in toolSkills" :key="skill.name">
                                <div class="mb-2 flex items-center justify-between">
                                    <span class="font-medium">{{ skill.name }}</span>
                                    <span class="text-xs text-muted-foreground">{{ skill.level }}/5</span>
                                </div>
                                <div class="h-2 overflow-hidden rounded-full bg-muted">
                                    <div 
                                        :class="getSkillColor(skill.level)"
                                        :style="{ width: `${(skill.level / 5) * 100}%` }"
                                        class="h-full transition-all duration-500"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 rounded-lg bg-muted p-4">
                            <p class="text-sm font-medium mb-2">Currently Learning</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="rounded-full bg-background px-3 py-1 text-xs">Docker</span>
                                <span class="rounded-full bg-background px-3 py-1 text-xs">RESTful APIs</span>
                                <span class="rounded-full bg-background px-3 py-1 text-xs">Deployment</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="min-h-screen px-4 py-20">
            <div class="mx-auto max-w-4xl">
                <div class="mb-12 text-center">
                    <h2 class="mb-4 text-3xl font-bold sm:text-4xl">About Me</h2>
                </div>

                <div class="grid gap-8 md:grid-cols-[auto_1fr]">
                    <!-- Photo Placeholder -->
                    <div class="mx-auto flex h-48 w-48 items-center justify-center rounded-full bg-muted">
                        <p class="text-sm text-muted-foreground">Your Photo</p>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <h3 class="mb-2 text-xl font-semibold">{{ personalInfo.name }}</h3>
                            <p class="text-muted-foreground">
                                I'm a {{ personalInfo.status }} specializing in full-stack web development with a focus on Laravel and Vue.js. 
                                Based in {{ personalInfo.location }}, I'm passionate about building scalable web applications that solve real-world problems.
                            </p>
                        </div>

                        <div>
                            <h4 class="mb-2 font-semibold">Education</h4>
                            <p class="text-muted-foreground">
                                Bachelor of Science in Information Technology<br>
                                Expected Graduation: {{ personalInfo.graduation }}
                            </p>
                        </div>

                        <div>
                            <h4 class="mb-2 font-semibold">What I'm Looking For</h4>
                            <p class="text-muted-foreground">
                                I'm actively seeking opportunities to work on challenging projects where I can apply my Laravel and Vue.js expertise. 
                                I'm particularly interested in backend development roles but comfortable working across the full stack. 
                                {{ personalInfo.availability }}.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="min-h-screen px-4 py-20 bg-muted/30">
            <div class="mx-auto max-w-2xl">
                <div class="mb-12 text-center">
                    <h2 class="mb-4 text-3xl font-bold sm:text-4xl">Get In Touch</h2>
                    <p class="text-muted-foreground">Feel free to reach out for opportunities or collaborations</p>
                </div>

                <div class="space-y-8">
                    <!-- Email -->
                    <div class="text-center">
                        <a 
                            :href="`mailto:${contact.email}`"
                            class="inline-flex items-center gap-2 text-lg font-medium hover:text-primary transition-colors"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            {{ contact.email }}
                        </a>
                    </div>

                    <!-- Social Links Grid -->
                    <div class="grid gap-4 sm:grid-cols-2">
                        <a 
                            v-for="social in socials" 
                            :key="social.platform"
                            :href="social.url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex items-center gap-3 rounded-lg border bg-card p-4 hover:bg-accent transition-colors"
                        >
                            <component :is="getSocialIcon(social.icon)" class="h-5 w-5" />
                            <span class="font-medium">{{ social.platform }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="border-t py-8">
            <div class="mx-auto max-w-7xl px-4 text-center">
                <p class="text-sm text-muted-foreground">
                    © {{ new Date().getFullYear() }} {{ personalInfo.name }}. Built with Laravel & Vue.js
                </p>
            </div>
        </footer>
    </div>
</template>