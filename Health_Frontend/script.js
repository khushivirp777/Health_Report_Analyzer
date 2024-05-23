function analyzeReport() {
    const fileInput = document.getElementById('reportFile');
    const resultDiv = document.getElementById('result');
  
    if (fileInput.files.length > 0) {
      const file = fileInput.files[0];
      const fileName = file.name;
      const fileSize = (file.size / 1024).toFixed(2); // in KB
      const fileType = file.type;
  
      resultDiv.innerHTML = `
        <p>File Name: ${fileName}</p>
        <p>File Size: ${fileSize} KB</p>
        <p>File Type: ${fileType}</p>
      `;
    } else {
      resultDiv.innerHTML = '<p>No file selected.</p>';
    }
  }