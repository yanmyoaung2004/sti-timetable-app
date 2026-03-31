
# Timetable Management System

A web-based **Timetable Management System** that allows users to create, manage, and visualize schedules efficiently. Built with **PHP**, **MySQL**, and a responsive frontend using **HTML, CSS, Bootstrap**, with **jQuery** for API interactions.

---

## Features

* **Schedule Creation & Management** – Add, edit, and delete timetable entries easily.
* **Visual Timetable** – Responsive and user-friendly timetable display.
* **API-Based Data Interaction** – jQuery handles asynchronous API calls for smooth updates.
* **Database-Driven** – MySQL backend stores schedules, user data, and other relevant information.
* **Responsive Design** – Built with Bootstrap to work on desktops, tablets, and mobile devices.

---

## Tech Stack

* **Backend:** PHP
* **Frontend:** HTML, CSS, Bootstrap, jQuery
* **Database:** MySQL
* **Additional Tools:** XAMPP / LAMP for local development

---

## Project Structure

```
timetable-management/
├─ backend/             # PHP scripts and API endpoints
├─ frontend/            # HTML, CSS, Bootstrap files
│  ├─ index.html
│  ├─ timetable.html
│  └─ assets/
│     ├─ css/
│     └─ js/
├─ database/            # MySQL scripts
└─ README.md
```

---

## Installation

1. Clone the repository:

```bash
git clone https://github.com/yanmyoaung2004/timetable-management.git
cd timetable-management
```

2. Set up the database:

* Create a MySQL database (e.g., `timetable_db`)
* Import the provided SQL script from the `database/` folder

3. Configure database connection in `backend/config.php`:

```php
<?php
$host = 'localhost';
$db   = 'timetable_db';
$user = 'root';
$pass = '';
```

4. Start your local server (XAMPP/LAMP/WAMP) and place the project in the web root.

5. Access the application via:

```
http://localhost/timetable-management/frontend/index.html
```

---

## Usage

1. Add timetable entries (subject, time, day, etc.).
2. Edit or delete entries as needed.
3. View the full timetable in a responsive interface.
4. Use the jQuery-powered interface for smooth API interactions.

---

## Security Highlights

* Input validation to prevent invalid entries
* Prepared statements to prevent SQL injection
* Role-based access for admin vs general users (optional enhancement)

---

## Future Enhancements

* User authentication and role management
* Export timetable as PDF or Excel
* Notifications and reminders for upcoming classes
* Drag-and-drop timetable interface for easier management

---

## License

MIT License

