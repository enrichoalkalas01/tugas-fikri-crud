<div class="toast-stack" id="toastStack"></div>

<script>
(function () {
    const params = new URLSearchParams(window.location.search);
    const text = params.get('text');
    if (!text) return;

    const isSuccess = text.toLowerCase().includes('success');
    const icon = isSuccess ? '&#10003;' : '&#9888;';
    const cls  = isSuccess ? 'toast-success' : 'toast-error';

    const toast = document.createElement('div');
    toast.className = 'toast ' + cls;
    toast.innerHTML = '<span class="toast-icon">' + icon + '</span>'
                    + '<span class="toast-msg">' + text.replace(/</g, '&lt;') + '</span>';

    document.getElementById('toastStack').appendChild(toast);

    setTimeout(function () {
        toast.classList.add('hide');
        setTimeout(function () { toast.remove(); }, 280);
    }, 3500);

    // Clean URL without reload
    const url = new URL(window.location.href);
    url.searchParams.delete('text');
    history.replaceState(null, '', url.toString());
}());
</script>
</body>
</html>
