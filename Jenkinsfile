pipeline {
    agent any
    parameters {
        string(name: 'IMAGE_NAME', defaultValue: 'my-image', description: 'Name of the Docker image')
        string(name: 'IMAGE_TAG', defaultValue: 'latest', description: 'Tag for the Docker image')
    }
    stage('Building Docker image') { 
            steps { 
                script { 
                    dockerImage = docker.build("$DOCKER_TAG", "-f ./Dockerfile .")
                }
                sh '''
                docker images|grep $PROJECT_NAME
                '''
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
