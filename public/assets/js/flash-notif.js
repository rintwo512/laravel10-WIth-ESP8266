
document.addEventListener('DOMContentLoaded', function() {

        const flashSuccess = document.querySelector('.flash-success');        
        const flashNotif = flashSuccess.dataset.success;        
        if (flashNotif){             
            Lobibox.notify('success', {
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                position: 'top right',
                icon: 'bx bx-check-circle',
                msg: flashNotif
            });
        }

        
 });
 
 document.addEventListener('DOMContentLoaded', function() {
    const flashError = document.querySelector('.flash-error');
    const flashNotifError = flashError.dataset.error;        
    if (flashNotifError){ 
        Lobibox.notify('error', {
            pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
            position: 'top right',
            icon: 'bx bx-x-circle',
            msg: flashNotifError
        });
    }
});


 document.addEventListener('DOMContentLoaded', function() {
    const fieldErrors = document.querySelectorAll('.field-error');
    
    fieldErrors.forEach(function(fieldError) {
        const fieldNotifError = fieldError.getAttribute('data-field');
        
        if (fieldNotifError) {
            Lobibox.notify('error', {
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                position: 'top right',
                icon: 'bx bx-x-circle',
                msg: fieldNotifError
            });
        }
    });
});



        