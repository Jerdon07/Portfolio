<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    public function index()
    {
        return Inertia::render('Portfolio', [
            'personalInfo' => [
                'name' => 'Jerdon M. Litaoen',
                'title' => 'Full-Stack Developer',
                'subtitle' => 'Specializing in Laravel & React, Vue, and Livewire',
                'location' => 'Baguio, Benguet, Philippines',
                'status' => 'Information Technology Student',
                'graduation' => '2026',
                'availability' => 'Open to remote opportunities',
            ],
            'techStack' => [
                ['name' => 'Laravel', 'level' => 3, 'category' => 'backend'],
                ['name' => 'Vue.js', 'level' => 3, 'category' => 'frontend'],
                ['name' => 'Inertia.js', 'level' => 4, 'category' => 'frontend'],
                ['name' => 'TailwindCSS', 'level' => 5, 'category' => 'frontend'],
                ['name' => 'SQLite', 'level' => 4, 'category' => 'backend'],
                ['name' => 'TypeScript', 'level' => 2, 'category' => 'frontend'],
                ['name' => 'Git', 'level' => 3, 'category' => 'tools'],
            ],
            'projects' => [
                [
                    'id' => 1,
                    'name' => 'Hrvst',
                    'tagline' => 'Agricultural Marketplace Platform',
                    'description' => 'A comprehensive web application that helps admins manage vegetable prices, enables farmers to post their produce, and allows buyers to purchase vegetables directly from local farmers.',
                    'features' => [
                        'Multi-tenant architecture for different user roles (Admin, Farmer, Buyer)',
                        'Real-time price management system',
                        'Secure authentication and authorization',
                        'Responsive design optimized for mobile and desktop',
                        'Database optimization for scalability',
                    ],
                    'tech' => ['Laravel 12', 'Vue 3', 'Inertia.js', 'TailwindCSS', 'MySQL'],
                    'github' => 'https://github.com/Cresco-Team/Hrvst',
                    'live_url' => null,
                    'status' => 'In Development',
                    'year' => '2024-2025',
                    'image' => '/images/projects/hrvst.png', // You'll add screenshot later
                ],
            ],
            'socials' => [
                ['platform' => 'GitHub', 'url' => 'https://github.com/Jerdon07', 'icon' => 'github'], // Replace with your actual URLs
                ['platform' => 'LinkedIn', 'url' => 'https://www.linkedin.com/in/jerdon-litaoen-95057a3a4', 'icon' => 'linkedin'],
                ['platform' => 'Facebook', 'url' => 'https://www.facebook.com/jer.don.35/', 'icon' => 'facebook'],
                ['platform' => 'Discord', 'url' => 'https://discordapp.com/users/1218207427468726433', 'icon' => 'discord'],
            ],
            'contact' => [
                'email' => 'your.email@example.com', // Replace with your actual email
            ],
        ]);
    }
}
