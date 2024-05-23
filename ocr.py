import pytesseract
from PIL import Image

def ocr_pathology_report(image_path):
    # Open the image using PIL (Python Imaging Library)
    image = Image.open(image_path)
    
    # Perform OCR using Tesseract
    ocr_text = pytesseract.image_to_string(image)
    
    return ocr_text

# Path to the pathology report image
image_path = "ha.jpg"

# Perform OCR on the pathology report
ocr_result = ocr_pathology_report(image_path)

# Print the OCR result
print(ocr_result)
