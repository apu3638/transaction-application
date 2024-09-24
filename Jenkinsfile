pipeline {
    agent any
    parameters {
        string(name: 'IMAGE_NAME', defaultValue: 'my-image', description: 'Name of the Docker image')
        string(name: 'IMAGE_TAG', defaultValue: 'latest', description: 'Tag for the Docker image')
    }
    stages {
        stage('Building Docker image') { 
            steps { 
                script { 
                    // Use parameters to construct the image name
                    dockerImage = docker.build("${params.IMAGE_NAME}:${params.IMAGE_TAG}", "-f ./Dockerfile .")
                }
                sh '''
                docker images | grep ${params.IMAGE_NAME}
                '''
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
