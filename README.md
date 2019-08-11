# testTask
Step by step:
1. make sure that your system has docker and docker-compose
2. Clone repo - git clone git@github.com:agentsmity/testTask.git ~/testTask
3. Create image - cd ~/testTask && docker build -t test_image ./images/os/
4. Run containers - docker-compose up -d
5. Go to container and run initialize and run scripts:
    - docker exec -it testtask_test_1 bash
    - cd /home/testuser
    - . init.sh
    - . run.sh
6. To check how it works go to mysql - docker exec -it testtask_mysql_1 mysql (if there is an error - try `docker exec -it testtask_mysql_1 bash` and then #mysql) and look at the table `test`.`task`


But ooops... number of sum too large
+----+----------------------+-----------+-----------+
| id | sum                  | count_fib | count_sim |
+----+----------------------+-----------+-----------+
|  1 | 12200160415121820064 |        91 |       119 |
+----+----------------------+-----------+-----------+

