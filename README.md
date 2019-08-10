# testTask
Step by step:
1. make sure that your system has docker and docker-compose
2. Clone repo - git clone git@github.com:agentsmity/testTask.git ~/testTask
3. Create image - cd ~/testTask && docker build -t test_image ./images/os/
4. Run containers - docker-compose up -d
