pipeline {
    agent any

    environment {
        IMAGE_NAME = 'devops-lab-web'
    }

    options {
        skipDefaultCheckout(true)
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Build image') {
            steps {
                sh 'docker build -t ${IMAGE_NAME}:${BUILD_NUMBER} .'
            }
        }

        stage('Verify') {
            steps {
                sh 'docker images | grep ${IMAGE_NAME}'
            }
        }
    }
}
