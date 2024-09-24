pipeline {
    agent any
    environment {
        // Define environment variables here if needed
        DOCKER_TAG = 'my-image:latest' // Set default tag or use a parameter
        PROJECT_NAME = 'my-image' // Set project name or use a parameter
    }

    stages {
        stage('Init') {
            steps {
                script {
                    // Capture the latest commit ID
                    def commitId = sh(script: "git log -1 --pretty=format:'%h'", returnStdout: true).trim()
                    echo "........result of commit .... ${commitId}"
                }
            }
        }

        stage('Building Docker image') { 
            steps { 
                script { 
                    // Build the Docker image
                    def dockerImage = docker.build("${DOCKER_TAG}", "-f ./Dockerfile .")
                    echo "Docker image built: ${dockerImage}"
                }
                script {
                    // List the Docker images
                    sh "docker images | grep ${PROJECT_NAME}"
                }
            } 
        }
    }
}
