pipeline {
    agent any
    parameters {
        string(name: 'IMAGE_NAME', defaultValue: 'my-image', description: 'Name of the Docker image')
        string(name: 'IMAGE_TAG', defaultValue: 'latest', description: 'Tag for the Docker image')
    }
    stages {
        stage('Build Docker Image') {
            steps {
                script {
                    echo "Building Docker image ${params.IMAGE_NAME}:${params.IMAGE_TAG}..."
                    sh "docker build -t ${params.IMAGE_NAME}:${params.IMAGE_TAG} ."
                }
            }
        }
    }
    post {
        success {
            echo 'Pipeline succeeded!'
        }
        failure {
            echo 'Pipeline failed!'
        }
        always {
            echo 'Cleaning up...'
            // Any cleanup commands can go here
        }
    }
}
