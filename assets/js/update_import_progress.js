const updateProgressUrl = document.getElementById('progressBars').getAttribute('data-update-progress-url');

const progressBarOverallEl = document.getElementById('progressBarOverall');
const progressBarFilesEl = document.getElementById('progressBarFiles');
const progressBarLinesEl = document.getElementById('progressBarLines');

const interval = setInterval(async () => {
    const response = await fetch(updateProgressUrl);
    const json = await response.json();

    progressBarOverallEl.style.width = `${json.progress.overall}%`;
    progressBarOverallEl.innerText = `${json.progress.overall}%`;

    progressBarFilesEl.style.width = `${json.progress.files}%`;
    progressBarFilesEl.innerText = `${json.progress.files}%`;

    progressBarLinesEl.style.width = `${json.progress.lines}%`;
    progressBarLinesEl.innerText = `${json.progress.lines}%`;

    if (json.progress.overall === 100) {
        progressBarOverallEl.classList.remove('progress-bar-striped', 'progress-bar-animated');
        progressBarFilesEl.classList.remove('progress-bar-striped', 'progress-bar-animated');
        progressBarLinesEl.classList.remove('progress-bar-striped', 'progress-bar-animated');

        clearInterval(interval);
    }
}, 1000);