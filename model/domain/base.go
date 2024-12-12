package domain

import (
	"time"

	"github.com/google/uuid"
)

type ID struct {
	ID uuid.UUID `json:"id" gorm:"type:varchar(36); primaryKey"`
}

type CA struct {
	CreatedAt time.Time `json:"created_at"`
}

type UA struct {
	UpdatedAt time.Time `json:"updated_at"`
}

type TIMES struct {
	CA
	UA
}
