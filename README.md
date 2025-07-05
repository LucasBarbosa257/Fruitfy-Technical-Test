Back-end
Achieved 100% test coverage with all provided tests passing, ensuring code reliability using Laravel’s testing tools.

Implemented request validation to keep controllers clean and focused on their responsibilities.

Designed routes adhering to RESTful standards.

Created a queued job (NotifyContactJob) to asynchronously send email notifications upon contact deletion.

Developed a custom Mailable (NotifyContactMail) for professional and clear communication to users when their contact record is removed.


Front-end
Configured a modern front-end stack with Vue 3, Inertia.js, and Tailwind CSS, integrating smoothly with the Laravel back-end.

Developed all necessary CRUD views (List, Create, Update and Delete) for managing contacts.

Delivered a simple and clean design to accelerate development.

Due to the simplicity of the design, custom error messages and advanced validation UI were not implemented, focusing instead on core functionality and correctness.


Bonus Feature: Contact Deletion Notification
Upon contact deletion, the system dispatches a queued job to send an email notification.

This background processing guarantees a smooth user experience without delays.

Users receive clear confirmation emails improving transparency and trust.

Additional Notes
Some adjustments were made to the original test cases to better align them with the integrated front-end and back-end functionality, ensuring they reflect real usage flows.

Where I encountered unfamiliar topics or challenges during development, I leveraged AI-based tools to study, learn, and implement solutions effectively. This approach helped me overcome blockers and deepen my understanding.


Technologies Used
Laravel 11 (PHP 8.3)

Vue 3 + Inertia.js

Tailwind CSS

Laravel Queue (Jobs)

Laravel Mailables