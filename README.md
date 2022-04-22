#Task 1:
###Description
Write a program that receives two points in the format x1, y1, x2, y2 and checks if the distances between each point and the start of the cartesian coordinate system (0, 0) and between the points themselves is valid. A distance between two points is considered valid, if it is an integer value. In case a distance is valid write "{x1, y1} to {x2, y2} is valid", in case the distance is invalid write "{x1, y1} to {x2, y2} is invalid".

The order of comparisons should always be first {x1, y1} to {0, 0}, then {x2, y2} to {0, 0} and finally {x1, y1} to {x2, y2}.

The input consists of one string in which the coordinates are separated by “, “(look at the examples).

For each comparison print on the output either "{x1, y1} to {x2, y2} is valid" if the distance between them is valid, or "{x1, y1} to {x2, y2} is invalid"- if it’s invalid.


###Example:

####input: 3, 0, 0, 4

####output:

{3, 0} to {0, 0} is valid

{0, 4} to {0, 0} is valid

{3, 0} to {0, 4} is valid


####input: 2, 1, 1, 1 

####output:

???

???

???

#Task 2:

Write a program that substract and show all record from name column which contains float number for example: name = "Brora 1978 SMWS 26 Year Old 61.22svs" you need
to detect point number which is 61.22 and  display only all names contains floats from table.The data should be grouped by strength.Please see attach file how you need to display the data,need to be in following order: "id   name  strength". The records should be displayed in ascending order sorted by name. Please try to implement search field to be able to search by id,name,strength also need to have radio buttons for each id, name, strenght when select some of the radio buttons need to be sorted ascending accordingly for example if you choose id  need to sort all records by id ascending, if you choose strength sort all records by strength etc.Also need to have pagination to display 100 records per page. There is sql file attach whith one table please use it for this task.

Final result should look like this:

![img](https://github.com/tsubaku/bevvy/raw/master/img/image.png)

###Important notes:

Everything should be develop only with !!!PLAIN PHP NO FRAMEWORKS OR LIBRARYS!!!
