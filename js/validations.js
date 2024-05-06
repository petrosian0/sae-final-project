const form = document.querySelector('.ticket-form');


form.addEventListener('submit', (event) => {

    // Prevent form submission
        console.log("Form submit event triggered"); 
    event.preventDefault();

    const title = document.querySelector('#grid-title').value.trim();
    const description = document.querySelector('#grid-description').value.trim();

    let title_error = '';
    let description_error = '';

    const errorTitle = document.querySelector('.title-hidden');
    const errorDescription = document.querySelector('.description-hidden');

    
    errorTitle.innerHTML = ''; 
    errorDescription.innerHTML = ''; 

    // Title validation
    if (title === '') {
        title_error = 'Title is required.';
        errorTitle.classList.remove('hidden');

        let el = document.createElement('p'); 
        el.textContent = title_error;
        el.style.color = 'red'; 
        errorTitle.appendChild(el); 
    } else {
        errorTitle.classList.add('hidden'); 
    }

    // Description validation
    if (description === '') {
        description_error = 'Description is required.';
        errorDescription.classList.remove('hidden'); 

        let el = document.createElement('p'); 
        el.textContent = description_error;
        el.style.color = 'red'; 
        errorDescription.appendChild(el); 
    } else {
        errorDescription.classList.add('hidden'); 
    }

    // Check if there are any errors
    if (title_error === '' && description_error === '') {
        form.submit(); 
    }
});
