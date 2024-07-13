pipeline {
  agent any
  environment {
    IMAGE_NAME  = 'bs23'
    IMAGE_TAG   = 'v1'
    APP_NAME    = 'bs23'
    DOCKERHUB_CREDENTIALS = credentials('dockerhub') // Jenkins credentials ID for Docker Hub
  }
  stages {
     stage('Build Docker Image') {
        steps {
            script {
                // Build the Docker image
                sh "docker build -t ${IMAGE_NAME}:v1 ."
            }
        }
    }
    stage('Push Docker Image') {
        steps {
            script {
                // Log in to Docker Hub
                sh "echo ${DOCKERHUB_CREDENTIALS_PSW} | docker login -u ${DOCKERHUB_CREDENTIALS_USR} --password-stdin"
                // Push the Docker image to Docker Hub
                sh "docker push ${IMAGE_NAME}:v1"
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
  }
}
