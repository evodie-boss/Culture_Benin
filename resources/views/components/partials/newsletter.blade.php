{{-- resources/views/components/partials/newsletter.blade.php --}}
<section class="my-20 {{ $attributes->get('class') }}">
    <div class="max-w-4xl mx-auto px-6">
        <div class="bg-gradient-to-r from-stone-100 to-stone-200 rounded-3xl p-10 text-center border border-stone-300">
            <h2 class="text-4xl font-extrabold text-stone-800 mb-4">
                Restez connecté à la Culture Béninoise
            </h2>
            <p class="text-xl text-stone-600 mb-8 max-w-2xl mx-auto">
                Recevez chaque mois des contenus exclusifs sur les traditions, événements et découvertes culturelles du Bénin.
            </p>

            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input 
                    type="email" 
                    placeholder="Votre adresse email" 
                    required
                    class="flex-1 px-6 py-4 rounded-xl border border-stone-300 bg-white text-stone-800 placeholder-stone-500 focus:outline-none focus:ring-4 focus:ring-taupe-200 focus:border-taupe-500 transition">
                
                <button type="submit" 
                    class="bg-taupe-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-taupe-700 hover-lift transition shadow-lg">
                    S’abonner
                </button>
            </form>

            <p class="text-xs text-stone-500 mt-4">
                Zéro spam · Désinscription en 1 clic
            </p>
        </div>
    </div>
</section>