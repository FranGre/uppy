import './bootstrap'
import Uppy from '@uppy/core'
import Dashboard from '@uppy/dashboard'
import XHRUpload from '@uppy/xhr-upload'
import '@uppy/core/dist/style.min.css'
import '@uppy/dashboard/dist/style.min.css'

const uppy = new Uppy({
    restrictions: {
        allowedFileTypes: ['image/*'],
        maxNumberOfFiles: 1,
        minNumberOfFiles: 1,
        maxFileSize: 20000000
    }
})

uppy.use(Dashboard, {
    inline: true,
    target: '#uppy',
    theme: 'auto',
    showProgressDetails: true,
    showRemoveButtonAfterComplete: true,
})

uppy.use(XHRUpload, {
    fieldName: 'image',
    endpoint: '/upload/image',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
})

uppy.on('file-removed', (file) => {
    fetch('/delete/image', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ filename: file.meta.name })
    })
})