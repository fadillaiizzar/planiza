<div id="sdgsGuideModal" class="hidden fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-5xl w-full max-h-[85vh] shadow-2xl flex flex-col overflow-hidden">
        <div class="bg-gradient-to-r from-slate-navy to-blue-900 px-8 py-6 flex justify-between items-center flex-shrink-0">
            <h3 class="text-2xl font-bold text-white flex items-center gap-3">
                <span>📚</span> Panduan SDGs & Contoh Kegiatan
            </h3>
            <button onclick="closeSDGsGuideModal()" class="text-white hover:text-blue-200 text-3xl font-light transition-colors">×</button>
        </div>

        <div class="flex-1 overflow-y-auto px-8 py-8 scrollbar-hide">
            <div id="sdgsGuideContent" class="grid md:grid-cols-2 gap-5"></div>
        </div>

        <div class="bg-off-white border-t-2 border-border-gray px-8 py-5 flex justify-between items-center flex-shrink-0">
            <button
                id="guidePrevBtn"
                onclick="prevGuidePage()"
                class="px-6 py-3 border-2 border-border-gray text-cool-gray rounded-xl font-bold hover:border-slate-navy hover:text-slate-navy transition-all disabled:opacity-30"
            >
                ← Sebelumnya
            </button>

            <span id="guidePageInfo" class="text-sm font-bold text-slate-navy"></span>

            <button
                id="guideNextBtn"
                onclick="nextGuidePage()"
                class="px-6 py-3 bg-slate-navy text-white rounded-xl font-bold hover:bg-blue-900 transition-all disabled:opacity-30"
            >
                Selanjutnya →
            </button>
        </div>
    </div>
</div>
