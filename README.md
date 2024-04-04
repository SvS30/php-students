## PHP Students
Admin Students in PHP native with Bootstrap.

### Folder Structure
#### - functions
folder containing functions that can be used global by students actions, as:
- index.php: Get students data
- destroy.php: Destroy student action
- getById.php: Get student data by id
- store.php: Store a new student
- update.php: Update a student

#### - includes
folder containing code as Kernel (db connection, log in, etc)
- connection.php: DB Connection
- login.php: Sign in
- logout.php: Sign out
- verifySession.php: Middleware checking session

#### - public
folder containing resources by frontend.
- assets: CSS, JS.
- views: Template and views.

### Requeriments
- PHP 8.2
- mysqli extension
- Set database credentials:
 - on  `includes/connection.php` set
   - `dbHost`
   - `dbUsername`
   - `dbPassword`
   - `dbName`

### How to Run
- after clone code, open a terminal on the folder and run: `php -S localhost:8000`