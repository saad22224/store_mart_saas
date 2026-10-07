
<div class="mp-search-overlay" id="mpSearchOverlay" aria-hidden="true" hidden>
    <div class="mp-search-panel" dir="rtl">
        <button type="button" class="mp-search-close" id="mpSearchClose" aria-label="إغلاق">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <form action="<?php echo e(URL::to(@$storeinfo->slug . '/search')); ?>" method="GET" class="mp-underline-search" role="search">
            <label class="mp-underline-label" for="mpSearchInput">بحث</label>
            <div class="mp-underline-row">
                <button type="submit" class="mp-underline-icon" aria-label="بحث">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <input type="search" name="search_input" id="mpSearchInput" value="<?php echo e(request()->get('search_input')); ?>" autocomplete="off">
            </div>
        </form>
    </div>
</div>
<script>
(function () {
    function openMpSearch() {
        var o = document.getElementById('mpSearchOverlay');
        if (!o) return;
        o.hidden = false;
        o.setAttribute('aria-hidden', 'false');
        o.classList.add('is-open');
        document.documentElement.classList.add('mp-drawer-lock');
        setTimeout(function () {
            var i = document.getElementById('mpSearchInput');
            if (i) i.focus();
        }, 80);
    }
    function closeMpSearch() {
        var o = document.getElementById('mpSearchOverlay');
        if (!o) return;
        o.classList.remove('is-open');
        o.setAttribute('aria-hidden', 'true');
        o.hidden = true;
        document.documentElement.classList.remove('mp-drawer-lock');
    }
    window.mpOpenSearch = openMpSearch;
    window.mpCloseSearch = closeMpSearch;
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-mp-open-search]').forEach(function (el) {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                openMpSearch();
            });
        });
        var c = document.getElementById('mpSearchClose');
        if (c) c.addEventListener('click', closeMpSearch);
        var o = document.getElementById('mpSearchOverlay');
        if (o) o.addEventListener('click', function (e) {
            if (e.target === o) closeMpSearch();
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeMpSearch();
        });
    });
})();
</script>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\partials\search_overlay.blade.php ENDPATH**/ ?>