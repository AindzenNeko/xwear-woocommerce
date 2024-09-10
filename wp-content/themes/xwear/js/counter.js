function counters_init(){
    let counters = document.querySelectorAll('[data-counter]')

    counters.forEach(counter => {
        const counterInput = counter.querySelector('input');

        let max = parseInt(counterInput.max)
        let min = parseInt(counterInput.min)
        let value = parseInt(counterInput.value)

        // Observe on min and max values
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.attributeName === 'min') {
                    min = parseInt(counterInput.min);
                }
                if(mutation.attributeName === 'max') {
                    max = parseInt(counterInput.max);
                }
            });
        });

        observer.observe(counterInput, {
            attributes: true, // Отслеживаем изменения атрибутов
            attributeFilter: ['min', 'max'],
        });

        if(!value || value < min || value > max) {
            counterInput.value = min
        }
        
        counter.addEventListener('click', e => {
            const target = e.target

            if(target.closest('.counter__btn')) {
                e.preventDefault()
                let value = parseInt(target.closest('.counter').querySelector('input').value)
        
                if(target.classList.contains('plus__btn')) {
                    ++value;
                }
                if(target.classList.contains('minus__btn')) {
                    --value;
                }
                if(value <= min) {
                    value = min;
                }
                if(value >= max) {
                    value = max
                }
                target.closest('.counter').querySelector('input').value = value
            }
        })
    })
}
counters_init()