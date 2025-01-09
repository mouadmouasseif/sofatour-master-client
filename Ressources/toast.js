
    function error_toast(title,message)
    {

        cuteToast({
            type: "error", // or 'info', 'error', 'warning'
            title: "Error",
            message: message,
            timer: 5000
            });
    }

    const urlParams = new URLSearchParams(window.location.search);

    const error = urlParams.get('error');
    if(error != null)
    {
        error_toast("error",error);
    }
