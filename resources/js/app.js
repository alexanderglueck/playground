import './bootstrap';
import CKEditor from './ckeditor'

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

if (document.querySelector('.editor')) {
    const watchdog = new CKEditor.EditorWatchdog();

    window.watchdog = watchdog;

    watchdog.setCreator((element, config) => {
        return CKEditor.Editor
            .create(element, config)
            .then(editor => {
                return editor;
            })
    });

    watchdog.setDestructor(editor => {
        return editor.destroy();
    });

    watchdog.on('error', handleError);

    watchdog
        .create(document.querySelector('.editor'), {
            licenseKey: '',
        })
        .catch(handleError);

    function handleError(error) {
        console.error('Oops, something went wrong!');
        console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
        console.warn('Build id: rbnysgs3239q-x2kuft1n1ixy');
        console.error(error);
    }
}

if (document.querySelector('.create-tenant')) {
    let tenantReady = false;

    let intervalId = window.setInterval(function () {
        axios.post('/api/workspace/availability', {
            workspace: document.querySelector('input[type=hidden][name=workspace].js-val').value
        })
            .then(res => {
                tenantReady = !res.data.available;

                if (tenantReady) {
                    clearInterval(intervalId);
                    document.querySelector('button.create-tenant').disabled = false
                }
            })
    }, 5000);
}
