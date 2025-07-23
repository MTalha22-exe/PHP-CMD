# File Upload and Management System

## 📝 Description  
A PHP-based web application for uploading, viewing, editing, and deleting files (PDF, JPG, PNG) with a 2MB size limit.

## ✨ Features  
- ✅ Secure file uploads with type/size validation  
- 📂 Database storage of file metadata  
- 📱 Responsive design  
- 🔍 Interactive DataTables for file listing  
- 🗑️ Delete confirmation dialogs  
- 👁️ File preview capability  

## 🛠️ Technologies  
- PHP (Backend)  
- MySQL (Database)  
- HTML5 & CSS3 (Frontend)  
- JavaScript/jQuery (Interactivity)  
- DataTables (Enhanced tables)  

## 📂 File Structure  
project/
├── delete.php - File deletion handler
├── files.php - File editor
├── index.php - Main interface
├── style.css - Stylesheet
├── upload.php - Upload handler
└── uploads/ - Upload storage


## 🚀 Installation  

### Prerequisites  
- Web server (Apache/Nginx) with PHP  
- MySQL database  
- PHP extensions: `mysqli`, `fileinfo`  

### Setup  
1. Create database:  
   ```sql
   CREATE TABLE files (
       id INT AUTO_INCREMENT PRIMARY KEY,
       filename VARCHAR(255) NOT NULL,
       filepath VARCHAR(255) NOT NULL,
       filesize INT NOT NULL,
       uploaded_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
2. Create writable uploads directory
3. Update credentials in all PHP files if needed (default: root/no password)

🖥️ Usage
1. Access via browser
2. Upload files via form
3. Manage files using:

    •👁️ View: Open file
    •✏️ Edit: Replace file
    •🗑️ Delete: Remove permanently

🔒 Security Notes
⚠️ For production:

 •Change default database credentials

 •Implement user authentication

 •Add file content validation

 •Consider storing uploads outside web root

📜 License
Open-source - Modify and distribute freely.

👨‍💻Author
Muhammad Talha | MTalha22

