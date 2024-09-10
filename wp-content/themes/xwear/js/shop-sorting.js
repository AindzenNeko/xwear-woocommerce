document.addEventListener('DOMContentLoaded', function () {
    const selects = document.querySelectorAll('.dropdown')

    selects.forEach(dropdown => {
        const dropdownBtn = dropdown.querySelector('.dropdown__btn');
        const dropdownList = dropdown.querySelector('.dropdown__list');
        const dropdownItems = dropdown.querySelectorAll('.dropdown__list--item');
        const hiddenInput = dropdown.querySelector('.dropdown__input-hidden');

        dropdownItems.forEach(item => {
            if(item.hasAttribute('selected')) {
                dropdownBtn.textContent = item.textContent;
            }
        })
        
        dropdownItems.forEach(item => {
            item.addEventListener('click', function () {
                const value = this.getAttribute('data-value');
                const text = this.textContent;
                hiddenInput.value = value;
                dropdownBtn.textContent = text;
                dropdownList.classList.remove('show');

                // Submit the form
                // const form = this.closest('form');
                // if (form) {
                //     form.submit();
                // }
            });
        });
    })  
});