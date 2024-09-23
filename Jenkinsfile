pipeline {
  agent any
  environment {
    IMAGE_NAME = 'darinpope/jenkins-example-laravel'
    IMAGE_TAG = 'latest'
    APP_NAME = 'jenkins-example-laravel'
  }
  stages {
    stage('Check Docker Version') {
      steps {
        script {
          sh "docker --version"
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
