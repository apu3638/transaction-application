pipeline {
    agent any

    stages {
        stage('Build Docker Image') {
            steps {
                script {
                    // Build the Docker image
                    def dockerImage = docker.build("my-image:latest")
                    echo "Docker image built: ${dockerImage}"
                }
            }
        }
    }
}
