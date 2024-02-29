document.addEventListener('DOMContentLoaded', () => {

    const form = document.querySelector('section.servers-selector form');
    const checkboxes = form.querySelectorAll('input[type="checkbox"]');
    const instructions = form.querySelectorAll('.instruction');

    let player;
    let enemy;

    const hideInstructions = () => {
        instructions.forEach((instruction) => {
            instruction.style.display = 'none';
        });
    };

    const showInstruction = (instruction) => {
        element = form.querySelector('.instruction.' + instruction);
        element.style.display = 'initial';

        switch (instruction) {
            case 'player':
                form.style.setProperty('--selector-state', '#059899');
                break;
            case 'enemy':
                form.style.setProperty('--selector-state', '#74507A');
                break;
        }
    };

    hideInstructions();
    showInstruction('player');

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        if (player && enemy) {
            player.value = player.name;
            player.name = 'player';

            enemy.value = enemy.name;
            enemy.name = 'enemy';

            form.submit();
        }
    });

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('click', () => {
            if (checkbox.checked) {
                if (!player) {
                    player = checkbox;
                    player.classList.add('player');

                    hideInstructions();
                    showInstruction('enemy');
                } else if (!enemy) {
                    enemy = checkbox;
                    enemy.classList.add('enemy');

                    hideInstructions();
                    showInstruction('ready');
                    form.style.setProperty('--selector-state', '#059899')
                } else {
                    player.checked = false;
                    enemy.checked = false;

                    player.classList.remove('player');
                    enemy.classList.remove('enemy');
    
                    player = null;
                    enemy = null;
    
                    player = checkbox;
                    player.classList.add('player');

                    hideInstructions();
                    showInstruction('enemy');
                }
            } else {
                player.checked = false;
                enemy.checked = false;

                player.classList.remove('player');
                enemy.classList.remove('enemy');

                player = null;
                enemy = null;

                hideInstructions();
                showInstruction('player');
            }
        });
    });

});