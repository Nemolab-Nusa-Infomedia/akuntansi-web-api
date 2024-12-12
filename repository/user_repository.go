package repository

import (
	"akutansi-web-api/model/domain"
)

type UserRepository interface {
	FindAll() ([]*domain.UserPublic, error)
}
