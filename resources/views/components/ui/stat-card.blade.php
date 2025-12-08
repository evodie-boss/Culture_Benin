{{-- resources/views/components/ui/stat-card.blade.php --}}
<div {{ $attributes->merge(['class' => 'group relative overflow-hidden bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300']) }}>
    <!-- Background decoration -->
    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-green-50 to-gray-50 rounded-full -translate-y-12 translate-x-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
    
    <!-- Main content -->
    <div class="relative z-10">
        <!-- Icon (optional) -->
        @if($icon ?? false)
            <div class="w-14 h-14 mb-6 mx-auto bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                <i class="{{ $icon }} text-white text-xl"></i>
            </div>
        @endif
        
        <!-- Number -->
        <div class="text-5xl md:text-6xl font-bold text-gray-900 mb-3 group-hover:text-green-700 transition-colors duration-300">
            {{ $number ?? '0' }}
            @if($suffix ?? false)
                <span class="text-2xl text-gray-500">{{ $suffix }}</span>
            @endif
        </div>
        
        <!-- Label -->
        <div class="text-lg font-semibold text-gray-700 mb-2">
            {{ $slot }}
        </div>
        
        <!-- Description (optional) -->
        @if($description ?? false)
            <p class="text-sm text-gray-500 mt-2">
                {{ $description }}
            </p>
        @endif
        
        <!-- Trend indicator (optional) -->
        @if($trend ?? false)
            <div class="inline-flex items-center mt-3 px-3 py-1 rounded-full text-sm font-medium {{ $trend >= 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                @if($trend >= 0)
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                @else
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                @endif
                {{ abs($trend) }}%
            </div>
        @endif
        
        <!-- Divider -->
        <div class="mt-6 pt-6 border-t border-gray-100">
            <!-- Additional info (optional) -->
            @if($info ?? false)
                <div class="text-xs text-gray-500">
                    {{ $info }}
                </div>
            @else
                <!-- Animation on hover -->
                <div class="flex items-center justify-center text-sm text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <span>Mise à jour quotidienne</span>
                    <svg class="w-4 h-4 ml-1 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                    </svg>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Border effect on hover -->
    <div class="absolute inset-0 rounded-2xl border-2 border-transparent group-hover:border-green-300 transition-colors duration-300 pointer-events-none"></div>
</div>