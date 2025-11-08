<div id="sdgDetailModal" class="hidden fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl overflow-hidden animate-fade-in">
        <div class="bg-gradient-to-r from-slate-navy to-blue-900 px-8 py-6 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <span class="bg-white text-slate-navy px-4 py-2 rounded-xl font-bold text-2xl" id="sdgDetailNumber"></span>
                <h3 class="text-xl font-bold text-white" id="sdgDetailTitle">SDG Detail</h3>
            </div>
            <button onclick="closeSDGDetail()" class="text-white hover:text-blue-200 text-3xl font-light transition-colors">×</button>
        </div>
        <div class="px-8 py-8">
            <p class="text-cool-gray leading-relaxed text-base" id="sdgDetailDesc"></p>
        </div>
    </div>
</div>
