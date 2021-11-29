USE [DB_SOLVUS]
GO

/****** Object:  Table [dbo].[TAR_ROLE_HAS_PERMISSIONS]    Script Date: 11/30/2021 3:06:28 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[TAR_ROLE_HAS_PERMISSIONS](
	[permission_id] [bigint] NOT NULL,
	[role_id] [bigint] NOT NULL,
 CONSTRAINT [role_has_permissions_permission_id_role_id_primary] PRIMARY KEY CLUSTERED 
(
	[permission_id] ASC,
	[role_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

ALTER TABLE [dbo].[TAR_ROLE_HAS_PERMISSIONS]  WITH CHECK ADD  CONSTRAINT [role_has_permissions_permission_id_foreign] FOREIGN KEY([permission_id])
REFERENCES [dbo].[TAR_PERMISSIONS] ([id])
ON DELETE CASCADE
GO

ALTER TABLE [dbo].[TAR_ROLE_HAS_PERMISSIONS] CHECK CONSTRAINT [role_has_permissions_permission_id_foreign]
GO

ALTER TABLE [dbo].[TAR_ROLE_HAS_PERMISSIONS]  WITH CHECK ADD  CONSTRAINT [role_has_permissions_role_id_foreign] FOREIGN KEY([role_id])
REFERENCES [dbo].[TAR_ROLES] ([id])
ON DELETE CASCADE
GO

ALTER TABLE [dbo].[TAR_ROLE_HAS_PERMISSIONS] CHECK CONSTRAINT [role_has_permissions_role_id_foreign]
GO


