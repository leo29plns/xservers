document.addEventListener('DOMContentLoaded', () => {
    const inputs = document.querySelectorAll('input.pad--end');

    const updateInputValue = (input) => {
        let cursorPosition = input.selectionStart;

        let value = input.value;
        
        const originalLength = value.length;
        value = value.replace(/^_+/, '');
        const charactersRemoved = originalLength - value.length;

        const remainingChars = 30 - value.length;
        if (remainingChars > 0) {
            value += "_".repeat(remainingChars);
        }
        
        if (value.length > 30) {
            value = value.substring(0, 30);
        }

        input.value = value;

        cursorPosition -= charactersRemoved;
        if (cursorPosition < 0) {
            cursorPosition = 0;
        }

        input.selectionStart = cursorPosition;
        input.selectionEnd = cursorPosition;
    };

    inputs.forEach(input => {
        input.addEventListener('input', () => {
            updateInputValue(input);
        });

        input.addEventListener('keydown', () => {
            setTimeout(() => {
                updateInputValue(input);
            });
        });

        updateInputValue(input);
    });
});
