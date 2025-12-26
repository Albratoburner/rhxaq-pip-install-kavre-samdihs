# Library Management System

A complete library borrowing management system built with Laravel that tracks books, members, and borrowing transactions with enforced business rules and state management.

## System Overview

This system manages a library's core operations:
- **Book Management**: Add and track books with ISBN, author, and copy availability
- **Member Management**: Register members with unique identification
- **Borrowing System**: Handle book checkouts and returns with automated tracking

## Database Schema

The system uses 3 related tables:

### Books Table
- `id` (Primary Key)
- `title` (NOT NULL)
- `isbn` (UNIQUE, NOT NULL)
- `author` (NOT NULL)
- `total_copies` (Integer)
- `available_copies` (Integer)

### Members Table
- `id` (Primary Key)
- `name` (NOT NULL)
- `email` (UNIQUE, NOT NULL)
- `membership_id` (UNIQUE, NOT NULL)
- `max_borrows` (Default: 3)

### Borrowings Table
- `id` (Primary Key)
- `book_id` (Foreign Key → books.id)
- `member_id` (Foreign Key → members.id)
- `borrowed_date` (Date)
- `due_date` (Date)
- `returned_date` (Date, nullable)
- `status` (Enum: borrowed, returned, overdue)
- Unique constraint on (book_id, member_id, status)

## Business Rules Enforced

The system enforces the following rules:

1. **No Duplicate Active Borrowings**: A member cannot borrow the same book twice while status is 'borrowed' (enforced via unique constraint and backend logic)

2. **Availability Check**: Books can only be borrowed if available_copies > 0

3. **Maximum Borrow Limit**: Members cannot exceed their max_borrows limit for active borrowings (default: 3 books)

4. **Unique Constraints**:
   - Each book must have a unique ISBN
   - Each member must have a unique email
   - Each member must have a unique membership_id

5. **Automatic Copy Tracking**: System automatically decrements available_copies when borrowed and increments when returned

## State Machine (borrowing_state.json)

The system implements a state machine for borrowing lifecycle:

**States:**
- `borrowed`: Book is currently borrowed by a member
- `returned`: Book has been returned (final state)
- `overdue`: Book is past due date and not yet returned

**Transitions:**
- borrowed → returned
- borrowed → overdue
- overdue → returned

The JSON file documents:
- Allowed state transitions
- Business rules for each state
- Example of current state representation

## How to Run

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL or SQLite database

### Installation Steps

1. Clone the repository
```bash
git clone <repository-url>
cd libraryapp
```

2. Install dependencies
```bash
composer install
```

3. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Update database configuration in `.env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_db
DB_USERNAME=root
DB_PASSWORD=
```

5. Run migrations
```bash
php artisan migrate
```

6. Start the development server
```bash
php artisan serve
```

7. Access the application at `http://127.0.0.1:8000`

## How to Test

### Manual Testing

1. **Register/Login**: Create a user account at `/register` or login at `/login`

2. **Add Books**: Navigate to Books section and add books with unique ISBNs

3. **Register Members**: Add members with unique email and membership IDs

4. **Test Borrowing Rules**:
   - Borrow a book for a member
   - Try to borrow the same book again for the same member (should fail)
   - Try to borrow when available_copies = 0 (should fail)
   - Borrow 3 books for a member, then try a 4th (should fail)

5. **Test Returns**: Return borrowed books and verify available_copies increments

### Testing Business Rules

1. **Duplicate Prevention**: 
   - Borrow Book A for Member X
   - Try to borrow Book A for Member X again → Should show error

2. **Availability Check**:
   - Add a book with 1 copy
   - Borrow it
   - Try to borrow it again for different member → Should show error

3. **Max Borrow Limit**:
   - Set member max_borrows to 3
   - Borrow 3 books
   - Try to borrow 4th book → Should show error

## Project Structure

```
app/
  Http/Controllers/
    BookController.php       - Book management
    MemberController.php     - Member management
    BorrowingController.php  - Borrowing logic with rules
    HomeController.php       - Dashboard
    AuthController.php       - Authentication
  Models/
    Book.php
    Member.php
    Borrowing.php
database/
  migrations/              - Database schema
resources/
  views/                  - Blade templates
routes/
  web.php                 - Application routes
borrowing_state.json      - State machine documentation
```

## Key Features

- User authentication (login/register)
- Real-time availability tracking
- Business rule enforcement with database transactions
- State-based borrowing lifecycle
- Professional UI with responsive design
- Error handling and validation

## Technologies Used

- Laravel 11
- PHP 8.4
- Blade Templates
- CSS3
- MySQL

## License

Open-source software licensed under the MIT license.
