## DATA:

I’ve downloaded my dataset from a subsidiary called Kaggle. My dataset books.json contains various fields related to books like book ID, title, authors, average_rating, ISBN, ISBN13, language_code, num_pages, ratings_count, text_reviews_count. 

## IMPLEMENTATION:

### Account registration:

The account registration has been done using an ajax call and php. This is implemented in the index.js and signup.php files. The activate.php and connection.php files are used to establish the connection of the database and email. The account registration doesn’t allow duplicate email registration. The same password has to be entered twice for confirmation otherwise an error message is displayed. A confirmation email is sent to the user after a successful registration. The user can activate his account through the link in the confirmation email. I’ve done this part using the php mail function.
The sign up page has a reCAPTCHA verification. In order to implement this reCAPTCHA (v2), first I registered my site in the reCAPTCHA website and obtained the required keys (responseKey, secretKey) and script. Then, I wrote an if-else condition using the obtained keys so that the users can signup only if they check the reCAPTCHA. 

### Account login (including reCAPTCHA):

The login page has been done using an ajax call and php, similar to that of the registration page. There’s a forgot password feature to reset their password that sends a link to their email where they can reset it by entering a new password. The code is in the login.php and index.js files. The activate.php and connection.php files are used to establish the connection of the database and email. 
The login page has a reCAPTCHA verification. In order to implement this reCAPTCHA (v2), first I registered my site in the reCAPTCHA website and obtained the required keys (responseKey, secretKey) and script. Then, I wrote an if-else condition using the obtained keys so that the users can login only if they check the reCAPTCHA.

### Password reset:

The users can update or reset their password in case they forget it. The source code can be found in the storeresetpassword.php file. The ajax call has been called in the index.js file. In order for the users to reset their password a confirmation mail will be sent to their email where they have to verify the change.

### Users’ homepage:

The user’s homepage consists of the user’s profile, add books, favorites and home fields. The user can add books or save favorite books to the database only if he logs in. The profile page consists of the general account settings like the username, email and password where the users can update this information. After the user logs in, there’s a button on the right that says logged in as your username. There’s also a search container where the user can search different books according to his choice. The advanced search only works if the user logs in. 
After the search the user can logout of their profile through the logout button that takes back to the homepage. The content of the user’s homepage can be found in the mainpageloggedin.php file. 

### Main search function:

The key components that connect the front end of my search engine to ElasticSearch are the various functions
that I’ve used like the search, isset and variables like $GET. Further, in order to implement the search function, I’ve
used various Elasticsearch functions like index (gives the index name ‘book’), type (document), multi match (takes
various fields at once and implements the search), fields (what are the specified fields).
'multi_match' => ['query' => $q, ‘fields’[‘ title‘ , ‘authors‘]]
The above function takes the two fields ‘title’ and ‘authors’ and gives back the search results according to them.
The results are then generated in a separate page and I’ve done this using the isset function and <?php echo ‘ ‘ ?>
statement. This is implemented in the index.php and the results are displayed in display.php file. 

### Advanced search function:

The advanced search has various fields where the users can filter their search results by book title, author, ISBN, rating. I’ve also implemented the Speech-to-text API in the advanced search field where the users can search a query by recording it. The advanced search is implemented similar to the main search function using the multi match function. The content can be found in the file advance.php

### SERP:

The content of the SERP can be found in the display.php file. The SERP contains a search bar where the users can search for various books. It displays 10 results per page where the results are paginated. The search terms are also highlighted where we used a user defined highlightwords function. 

### XSS vulnerability filtering:

In order for the SERP to display the actual term (after sanitization) on top, I’ve used the trim() and strip_tags() function and it goes like this : $q =trim(strip_tags($_GET['q'])); where q is my result. The code can be found in display.php and display2.php.

## Insert a new entry:

The users can add a new book to the database only if they login. The content of this can be found in the add.php file. There’s an alert that says if the books have been successfully indexed. The users can add a book title, author’s name and the book’s ISBN number to the elasticsearch. 

### Pagination:

My pagination is based on the concept how the control module fetches the total results from the Model (data), then sorts the first N elements and fetches another N results when the user clicks the next page link. I’ve used a List, JavaScript and Ajax to implement the pagination. 10 results are displayed per page since I’ve given page:10, pagination: true in my function. The code can be found in display.php and display2.php.

### Highlighting search terms:

I’ve used the PHP ONCLICKevent and highlightwords() function in order to highlight the results containing that particular search terms. The highlighting works for all the pages after pagination as well. The source code can be found in display.php and display2.php files. 

### Save items to user’s profiles:

I’ve created a savedbooks database in order for the users to save their favorite books. The content of this can be found in favorite.php file. The users can save books only if they login.  The saved favorite items are again re-directed to an external link where there’s much detailed description of the result. The user can delete the items from the favorites. 

### Spell check, autocompletion, Google Map API or Speech-to-text API:

I’ve implemented the Speech-to-text API in the advanced search filed. I’ve used a function startRecording() in order to implement this and the content can be found in the mainpageloggedin.php and advance.php. 

## Challenges and Lessons:

The most challenging parts of this project for me were the implementation of advanced search using the multi match function, re-directing the search result to an external link and pagination. Initially, my search terms were not being highlighted in the paginated results. I rectified it by using the proper pagination syntax. 
If I’d have the chance to do it again, I would be more thorough with php and javascript and would’ve implemented more advanced features which would make my site look much better.






