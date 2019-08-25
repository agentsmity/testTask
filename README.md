# Large numbers adder
Step by step:
1. make sure that your system has docker and docker-compose
2. Clone repo - git clone git@github.com:agentsmity/testTask.git ~/testTask
3. Create image - cd ~/testTask && docker build -t test_image ./images/os/
4. Run containers - docker-compose up -d
5. Go to container and run initialize and run scripts:
    - docker exec -it testtask_test_1 bash
    - cd /home/testuser
    - . init.sh (dependency install, storages prepare, logs clear)
    - . run.sh (run supervisor deamon from config ~/testTask/data/conf/supervisor)
6. To check how it works see logs in folder ~/testTask/data/home/log/*
    - dump.log contains dump from table (sum, count_fib, count_sim) and first 5 symbols of calculated sum with name of worker
    - produsers and consumers log - generated and received number of each type
    - sum.log has one nubmer - calculated sum of 2000 fibonacci numbers and 5000 Mersenne's numbers
