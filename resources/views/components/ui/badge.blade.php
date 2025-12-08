{{-- resources/views/components/ui/badge.blade.php --}}
@props([
    'variant' => 'default',
    'size' => 'md',
    'icon' => null,
    'iconPosition' => 'left',
    'dismissible' => false,
    'onDismiss' => null,
])

@php
    // Classes par variante
    $variantClasses = match($variant) {
        'default' => 'bg-secondary-700 text-white',
        'primary' => 'bg-gradient-to-r from-green-500 to-green-600 text-white',
        'secondary' => 'bg-gradient-to-r from-teal-500 to-teal-600 text-white',
        'success' => 'bg-gradient-to-r from-green-500 to-emerald-600 text-white',
        'warning' => 'bg-gradient-to-r from-amber-500 to-amber-600 text-white',
        'danger' => 'bg-gradient-to-r from-red-500 to-red-600 text-white',
        'info' => 'bg-gradient-to-r from-blue-500 to-blue-600 text-white',
        'light' => 'bg-gradient-to-r from-secondary-100 to-secondary-200 text-secondary-800',
        'dark' => 'bg-gradient-to-r from-secondary-800 to-secondary-900 text-white',
        'outline-primary' => 'border border-green-500 text-green-600 bg-green-50',
        'outline-secondary' => 'border border-secondary-300 text-secondary-700 bg-white',
        'pill' => 'rounded-full',
        'soft-primary' => 'bg-green-100 text-green-700',
        'soft-success' => 'bg-emerald-100 text-emerald-700',
        'soft-warning' => 'bg-amber-100 text-amber-700',
        'soft-danger' => 'bg-red-100 text-red-700',
        'soft-info' => 'bg-blue-100 text-blue-700',
        default => 'bg-secondary-700 text-white',
    };
    
    // Classes par taille
    $sizeClasses = match($size) {
        'xs' => 'px-2 py-0.5 text-xs',
        'sm' => 'px-2.5 py-1 text-sm',
        'md' => 'px-3 py-1.5 text-sm',
        'lg' => 'px-4 py-2 text-base',
        'xl' => 'px-5 py-2.5 text-lg',
        default => 'px-3 py-1.5 text-sm',
    };
    
    // Classes communes
    $baseClasses = 'inline-flex items-center justify-center font-semibold transition-all duration-200 hover:shadow-md';
    $roundedClass = $variant === 'pill' ? 'rounded-full' : 'rounded-lg';
    
    // Classe finale
    $classes = "$baseClasses $roundedClass $sizeClasses $variantClasses";
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon && $iconPosition === 'left')
        <i class="{{ $icon }} mr-1.5 {{ $size === 'xs' ? 'text-xs' : '' }}"></i>
    @endif
    
    {{ $slot }}
    
    @if($icon && $iconPosition === 'right')
        <i class="{{ $icon }} ml-1.5 {{ $size === 'xs' ? 'text-xs' : '' }}"></i>
    @endif
    
    @if($dismissible)
        <button type="button" 
                onclick="{{ $onDismiss ?: 'this.parentElement.remove()' }}"
                class="ml-2 -mr-1 p-0.5 hover:bg-white/20 rounded-full transition-colors focus:outline-none">
            <i class="fas fa-times text-xs"></i>
        </button>
    @endif
</span>

{{-- 
    EXEMPLES D'UTILISATION :
    
    1. Badge simple :
    <x-ui.badge>Nouveau</x-ui.badge>
    
    2. Badge avec variante :
    <x-ui.badge variant="primary">Populaire</x-ui.badge>
    <x-ui.badge variant="success">Validé</x-ui.badge>
    <x-ui.badge variant="warning">Attention</x-ui.badge>
    <x-ui.badge variant="danger">Urgent</x-ui.badge>
    
    3. Badge avec icône :
    <x-ui.badge variant="info" icon="fas fa-info-circle">Information</x-ui.badge>
    <x-ui.badge variant="primary" icon="fas fa-star" iconPosition="right">Premium</x-ui.badge>
    
    4. Badge avec taille personnalisée :
    <x-ui.badge size="xs">Mini</x-ui.badge>
    <x-ui.badge size="lg">Grand</x-ui.badge>
    
    5. Badge dismissible (fermable) :
    <x-ui.badge variant="warning" dismissible>
        Message temporaire
    </x-ui.badge>
    
    6. Badge soft (couleur douce) :
    <x-ui.badge variant="soft-primary">En attente</x-ui.badge>
    <x-ui.badge variant="soft-success">Approuvé</x-ui.badge>
    
    7. Badge outline :
    <x-ui.badge variant="outline-primary">Brouillon</x-ui.badge>
    
    8. Badge pill (entièrement rond) :
    <x-ui.badge variant="primary" size="xs" class="pill">42</x-ui.badge>
    
    9. Badge avec classes additionnelles :
    <x-ui.badge variant="primary" class="animate-pulse">Live</x-ui.badge>
--}}