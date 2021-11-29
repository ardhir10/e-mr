USE [DB_SOLVUS]
GO

/****** Object:  Table [dbo].[TAR_ASESMEN_PERAWAT]    Script Date: 11/30/2021 2:58:57 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[TAR_ASESMEN_PERAWAT](
	[FN_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[FD_DATE] [nvarchar](255) NULL,
	[FS_MR] [nvarchar](255) NULL,
	[FS_KD_LAYANAN] [nvarchar](255) NULL,
	[FS_PROFESI] [nvarchar](255) NULL,
	[FS_USER] [nvarchar](255) NULL,
	[FS_DPJP] [nvarchar](255) NULL,
	[FS_VERIFIED_BY] [nvarchar](255) NULL,
	[FS_REGISTER] [nvarchar](255) NULL,
	[FS_KD_PEG] [nvarchar](255) NULL,
	[FS_FROM] [nvarchar](255) NULL,
	[FS_TYPE] [nvarchar](255) NULL,
	[FS_ALASAN_KUNJUNGAN] [nvarchar](255) NULL,
	[FN_PF_TD] [nvarchar](255) NULL,
	[FN_PF_TB] [nvarchar](255) NULL,
	[FN_PF_NADI] [nvarchar](255) NULL,
	[FN_PF_BB] [nvarchar](255) NULL,
	[FN_PF_RESPIRASI] [nvarchar](255) NULL,
	[FN_PF_SUHU] [nvarchar](255) NULL,
	[FJ_RKU_RPD_PDRWT] [nvarchar](max) NULL,
	[FJ_RKU_RPD_PDOPR] [nvarchar](max) NULL,
	[FJ_RKU_RPD_MSDPO] [nvarchar](max) NULL,
	[FJ_RPK] [nvarchar](max) NULL,
	[FJ_KETERGANTUNGAN] [nvarchar](max) NULL,
	[FJ_RIWAYAT_ALERGI] [nvarchar](max) NULL,
	[FJ_RP_SPSI] [nvarchar](max) NULL,
	[FJ_RP_SMEN] [nvarchar](max) NULL,
	[FJ_RP_SSOS_HPDAK] [nvarchar](max) NULL,
	[FJ_RP_SSOS_KTYDD] [nvarchar](max) NULL,
	[FJ_RP_SEKO] [nvarchar](max) NULL,
	[FJ_RP_AGAMA] [nvarchar](max) NULL,
	[FJ_SN_RATE] [nvarchar](max) NULL,
	[FJ_SN_NYERI] [nvarchar](max) NULL,
	[FS_SN_LOKASI] [nvarchar](255) NULL,
	[FS_SN_DURASI] [nvarchar](255) NULL,
	[FS_SN_FREKUENSI] [nvarchar](255) NULL,
	[FJ_SN_NHB] [nvarchar](max) NULL,
	[FJ_SN_DKD] [nvarchar](max) NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[FN_ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO


