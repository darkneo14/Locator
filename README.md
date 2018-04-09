# Locator

This is a Web App for travelers. There are two modules involved in this project-
	1) Location based recommendations for best, shortest and most trending routes between two cities in India using the data of facebook checkins of logged in users.
	   Any User that logs in the sstem is asked to login via Facebook. This Gives us the right to take his timeline data and use that to further our database.
	2) Using Zomato Reviews for a restaraunt, we have used opinion mining techniques to create specific rating like ambience based, service based, etc. 
	   A user needs to choose a location and using that, we fetch restaraunts from zomato and pre-process the ratings for all these restaraunts and display them to the user.
	   

## Technologies Used

Php is the core language used for this project.
Neo4j graph database is used to store facebook checkin data and calculate insights using cypher query.
Mysql database is used to store data of restaraunts and other related information.
Facebook and Zomato apis are used to fetch data.