document.addEventListener('DOMContentLoaded', () => {
    if (!localStorage.getItem('loggedInToastShown')) {
        setTimeout(() => {
            let loggedInToast = new bootstrap.Toast(document.getElementById('logged_in_toast'));
            loggedInToast.show();

            setTimeout(() => {
                loggedInToast.hide();
                localStorage.setItem('loggedInToastShown', true);
            }, 3000);
        });
    }

    setTimeout(() => {
        let toastSuccess = new bootstrap.Toast(document.getElementById('toast_success'));
        toastSuccess.show();

        setTimeout(() => {
            toastSuccess.hide();
        }, 3000);
    });
});