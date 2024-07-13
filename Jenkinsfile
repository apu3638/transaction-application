pipeline {
  agent any
  environment {
    IMAGE_NAME  = 'limon408/bs23'
    IMAGE_TAG   = 'v2'
    APP_NAME    = 'bs23'
    // Note: DOCKERHUB_CREDENTIALS remains as is to be used in the script block
    DOCKERHUB_CREDENTIALS = credentials('dockerhub')
  }
  stages {
    stage('Build Docker Image') {
      steps {
        script {
          // Build the Docker image
          sh "docker build -t ${IMAGE_NAME}:${IMAGE_TAG} ."
        }
      }
    }
    stage('Push Docker Image') {
      steps {
        script {
          // Log in to Docker Hub
          sh "echo ${DOCKERHUB_CREDENTIALS_PSW} | docker login -u ${DOCKERHUB_CREDENTIALS_USR} --password-stdin"
          // Push the Docker image to Docker Hub
          sh "docker push ${IMAGE_NAME}:${IMAGE_TAG}"
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
