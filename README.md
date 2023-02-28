# php-forum-majaslapa

Lai palaistu projektu tiek izmantots XAMPP (Apache un MySql)
Iekš datubāzes ir jaizveido divas tabulas (users un posts)
Users sastāv no
  usersId (Primary Key INT)
  usersName (VARCHAR)
  usersEmail (VARCHAR)
  usersUid (VARCHAR)
  usersPwd (VARCHAR)
Posts sastāv no
  postsId (Primary Key INT)
  userInput (VARCHAR)
  publishedDate (DATE)
  usersId (INT)
