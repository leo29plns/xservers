document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input.pad--end');

    const cleanInputValue = (value) => {
        value = value.replace(/_+$/, '');
        value = value.replace(/^_+/, '');
        value = value.replace(/_+/g, '_');
        return value;
    };

    const updateInputValue = (input) => {
        const cursorPosition = input.selectionStart;

        let value = input.value;
        value = cleanInputValue(value);

        input.value = value;

        input.selectionStart = cursorPosition;
        input.selectionEnd = cursorPosition;
    };

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        inputs.forEach(input => {
            updateInputValue(input);
        });

        form.submit();
    });

    inputs.forEach(input => {
        input.addEventListener('input', () => {
            updateInputValue(input);
        });
    });
});
