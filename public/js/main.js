document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        let toastSuccess = new bootstrap.Toast(document.getElementById('toast_success'));
        toastSuccess.show();
        
        setTimeout(() => {
            toastSuccess.hide();
        }, 2300);
    });
    
    setTimeout(() => {
        let toastFailed = new bootstrap.Toast(document.getElementById('toast_failed'));
        toastFailed.show();
        
        setTimeout(() => {
            toastFailed.hide();
        }, 2300);
    });
});