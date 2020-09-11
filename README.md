# WAIHiHProject
Gallery Web Application that I made for Web development classes I had as a CS Student at GUT.
It has some limitations defined by the project requirements.
## Backend
It's backend is written ih PHP in which I had to implement MVC pattern myself, without any frameworks.
Application offers image upload, simple user authentication, image querying and restricting access to them
User data and links to hosted images are being stored in MongoDB. Each uploaded image is getting it's watermarked copy & thumbnail using PhpGD
## Frontend
Frontend is written in VanillaJS, requirements forced me to use jQuery aswell for some redundant DOM operations.
It's only practical task is to send ajax requests for searched image names.
